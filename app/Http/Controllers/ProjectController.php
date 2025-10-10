<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->latest('featured')->paginate(20);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'image' => 'nullable|string',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'technologies' => 'nullable',
            'featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);
        if (is_string($data['technologies'] ?? null)) {
            $decoded = json_decode($data['technologies'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['technologies'] = $decoded;
            }
        }
        $data['featured'] = (bool) ($data['featured'] ?? false);
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('ok', 'Projekt angelegt');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'image' => 'nullable|string',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'technologies' => 'nullable',
            'featured' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);
        if (is_string($data['technologies'] ?? null)) {
            $decoded = json_decode($data['technologies'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['technologies'] = $decoded;
            }
        }
        $data['featured'] = (bool) ($data['featured'] ?? false);
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('ok', 'Projekt aktualisiert');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('ok', 'Projekt gelöscht');
    }
}
