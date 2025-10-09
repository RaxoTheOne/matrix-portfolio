<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GitHubController extends Controller
{
    public function stats(Request $request)
    {
        $username = $request->query('username') ?: config('app.github_username', env('GITHUB_USERNAME'));
        $refresh = $request->boolean('refresh');
        if (!$username) {
            return response()->json([
                'error' => 'GITHUB_USERNAME not configured'
            ], 400);
        }

        $token = env('GITHUB_TOKEN');
        $cacheKey = "gh:stats:{$username}";

        if ($refresh) {
            Cache::forget($cacheKey);
        }

        $cached = Cache::get($cacheKey);
        if ($cached && !$refresh) {
            return response()->json($cached);
        }

        $data = (function () use ($username, $token) {
            $headers = [
                'Accept' => 'application/vnd.github+json',
                'X-GitHub-Api-Version' => '2022-11-28',
                'User-Agent' => 'matrix-portfolio-app',
            ];
            if ($token) {
                $headers['Authorization'] = 'Bearer ' . $token;
            }

            $client = Http::withHeaders($headers)->withOptions([
                'verify' => true,
                // Zeitlimits verhindern Hänger
                'timeout' => 10,
                'connect_timeout' => 5,
            ]);

            $userRes = $client->get("https://api.github.com/users/{$username}");
            if ($userRes->failed()) {
                return ['error' => 'github_users_failed', 'status' => $userRes->status(), 'body' => $userRes->json()];
            }
            $user = $userRes->json();

            $reposRes = $client->get("https://api.github.com/users/{$username}/repos", ['per_page' => 100]);
            if ($reposRes->failed()) {
                return ['error' => 'github_repos_failed', 'status' => $reposRes->status(), 'body' => $reposRes->json()];
            }
            $repos = $reposRes->json();

            $totalStars = 0;
            $languages = [];
            foreach ($repos as $repo) {
                $totalStars += $repo['stargazers_count'] ?? 0;
                if (!empty($repo['language'])) {
                    $languages[$repo['language']] = ($languages[$repo['language']] ?? 0) + 1;
                }
            }
            arsort($languages);
            $topLanguage = array_key_first($languages);

            return [
                'public_repos' => $user['public_repos'] ?? 0,
                'followers' => $user['followers'] ?? 0,
                'following' => $user['following'] ?? 0,
                'total_stars' => $totalStars,
                'total_forks' => array_sum(array_map(fn($r) => $r['forks_count'] ?? 0, $repos)),
                'languages_count' => count($languages),
                'top_language' => $topLanguage,
                'languages_map' => $languages,
                'languages_total' => array_sum($languages),
            ];
        })();

        if (!isset($data['error'])) {
            Cache::put($cacheKey, $data, now()->addMinutes(30));
        }

        return response()->json($data);
    }
    public function repos(Request $request)
    {
        $username = $request->query('username') ?: config('app.github_username', env('GITHUB_USERNAME'));
        $limit = (int) $request->query('limit', 12);
        $limit = max(1, min(50, $limit));
        if (!$username) {
            return response()->json(['error' => 'GITHUB_USERNAME not configured'], 400);
        }
        $token = env('GITHUB_TOKEN');
        $headers = [
            'Accept' => 'application/vnd.github+json',
            'X-GitHub-Api-Version' => '2022-11-28',
            'User-Agent' => 'matrix-portfolio-app',
        ];
        if ($token) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        $client = Http::withHeaders($headers)->withOptions([
            'verify' => true,
            'timeout' => 10,
            'connect_timeout' => 5,
        ]);

        $res = $client->get("https://api.github.com/users/{$username}/repos", ['per_page' => 100]);

        if ($res->failed()) {
            return response()->json(['error' => 'github_repos_failed', 'status' => $res->status(), 'body' => $res->json()], 502);
        }

        $repos = collect($res->json())
            ->sortByDesc('stargazers_count')
            ->take($limit)
            ->map(fn($r) => [
                'name' => $r['name'] ?? '',
                'html_url' => $r['html_url'] ?? '',
                'description' => $r['description'] ?? '',
                'language' => $r['language'] ?? null,
                'stargazers_count' => $r['stargazers_count'] ?? 0,
            ])
            ->values();

        return response()->json($repos);
    }
    public function pinned(Request $request)
    {
        $username = $request->query('username') ?: config('app.github_username', env('GITHUB_USERNAME'));
        if (!$username) {
            return response()->json(['error' => 'GITHUB_USERNAME not configured'], 400);
        }

        $token = env('GITHUB_TOKEN'); // benötigt für GraphQL
        if (!$token) {
            return response()->json(['error' => 'GITHUB_TOKEN missing'], 400);
        }

        $headers = [
            'Accept' => 'application/vnd.github+json',
            'X-GitHub-Api-Version' => '2022-11-28',
            'User-Agent' => 'matrix-portfolio-app',
            'Authorization' => 'Bearer ' . $token,
        ];

        $query = <<<'GQL'
    query($login:String!) {
      user(login:$login) {
        pinnedItems(first: 6, types: [REPOSITORY]) {
          nodes {
            ... on Repository {
              name
              description
              url
              stargazerCount
              primaryLanguage { name }
            }
          }
        }
      }
    }
    GQL;

        $res = Http::withHeaders($headers)->withOptions([
            'verify' => true,
            'timeout' => 10,
            'connect_timeout' => 5,
        ])->post('https://api.github.com/graphql', [
                    'query' => $query,
                    'variables' => ['login' => $username],
                ]);

        if ($res->failed()) {
            return response()->json([
                'error' => 'github_graphql_failed',
                'status' => $res->status(),
                'body' => $res->json(),
            ], 502);
        }

        $nodes = data_get($res->json(), 'data.user.pinnedItems.nodes', []);
        $pinned = collect($nodes)->map(fn($n) => [
            'name' => $n['name'] ?? '',
            'html_url' => $n['url'] ?? '',
            'description' => $n['description'] ?? '',
            'language' => data_get($n, 'primaryLanguage.name'),
            'stargazers_count' => $n['stargazerCount'] ?? 0,
        ])->values();

        return response()->json($pinned);
    }
}
