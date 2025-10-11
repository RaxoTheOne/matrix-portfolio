import "./bootstrap";

// Matrix rain background
window.addEventListener("load", () => {
    const canvas = document.getElementById("matrixRain");
    if (!canvas) return;
    const ctx = canvas.getContext("2d");

    const resize = () => {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    };
    resize();
    window.addEventListener("resize", resize);

    const letters =
        "アイウエオカキクケコサシスセソタチツテトナニヌネノABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    const fontSize = 14;
    let columns = Math.floor(canvas.width / fontSize);
    let drops = new Array(columns).fill(1);

    const draw = () => {
        ctx.fillStyle = "rgba(0, 0, 0, 0.08)";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = "#00ff7f";
        ctx.font = fontSize + "px monospace";

        for (let i = 0; i < drops.length; i++) {
            const text = letters.charAt(
                Math.floor(Math.random() * letters.length)
            );
            ctx.fillText(text, i * fontSize, drops[i] * fontSize);

            if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                drops[i] = 0;
            }
            drops[i]++;
        }
        requestAnimationFrame(draw);
    };
    draw();
});

// Tabs logic
document.addEventListener("click", (e) => {
    const btn = e.target.closest(".tab-btn");
    if (!btn) return;
    const id = btn.getAttribute("data-tab");
    document
        .querySelectorAll(".tab-btn")
        .forEach((b) => b.classList.remove("bg-[#072d1d]"));
    btn.classList.add("bg-[#072d1d]");
    document
        .querySelectorAll(".tab-panel")
        .forEach((p) => p.classList.add("hidden"));
    const panel = document.getElementById(id);
    if (panel) panel.classList.remove("hidden");
});

// Fetch GitHub stats and update placeholders
async function fetchGitHubStats(refresh = false) {
    try {
        // Platzhalter setzen
        document.querySelectorAll("[data-stat]")?.forEach((el) => (el.textContent = "…"));

        const username =
            document
                .querySelector("[data-username]")
                ?.getAttribute("data-username") || "RaxoTheOne";
        const url = `/github/stats?username=${encodeURIComponent(username)}${refresh ? "&refresh=1" : ""}`;
        const res = await fetch(url);
        if (!res.ok) throw new Error("Stats request failed");
        const data = await res.json();
        document.querySelectorAll("[data-stat]")?.forEach((el) => {
            const key = el.getAttribute("data-stat");
            if (data[key] !== undefined && data[key] !== null) {
                el.textContent = data[key];
            }
        });
        const mountLang = document.getElementById("lang-bars");
        if (mountLang) {
            if (data.languages_map) {
                const entries = Object.entries(data.languages_map);
                const total = data.languages_total || entries.reduce((s, [, c]) => s + c, 0);
                mountLang.innerHTML = entries
                    .map(([lang, count]) => {
                        const pct = total ? Math.round((count / total) * 100) : 0;
                        return `
                            <div class="border border-[#00ff7f33] rounded-sm p-3 bg-black/40">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="opacity-90">${lang}</span>
                                    <span class="opacity-80">${count} · ${pct}%</span>
                                </div>
                                <div class="mt-2 h-2 bg-black/40 border border-[#00ff7f33] rounded-sm">
                                    <div class="h-2 bg-[#00ff7f]" style="width:${pct}%"></div>
                                </div>
                            </div>
                        `;
                    })
                    .join("");
            } else {
                mountLang.innerHTML = "";
            }
        }
    } catch (e) {
        document.querySelectorAll("[data-stat]")?.forEach((el) => (el.textContent = "Fehler"));
        console.error(e);
    }
}
window.addEventListener("load", () => fetchGitHubStats());
document.addEventListener("click", (e) => {
    if ((e.target)?.id === "refresh-stats") {
        fetchGitHubStats(true);
    }
});

async function fetchRepos() {
    try {
        const mount = document.getElementById("repo-list");
        if (mount) {
            mount.innerHTML = `<div class="text-xs opacity-70">Lade Repos…</div>`;
        }
        const username =
            document
                .querySelector("[data-username]")
                ?.getAttribute("data-username") || "RaxoTheOne";
        const res = await fetch(
            `/github/repos?username=${encodeURIComponent(username)}&limit=36`
        );
        if (!res.ok) throw new Error("Repos request failed");
        const repos = await res.json();
        if (!mount) return;
        mount.innerHTML = repos
            .map(
                (r) => `
                <a href="${r.html_url}" target="_blank"
                    class="block border border-[#00ff7f33] rounded-sm p-4 bg-black/40 hover:bg-[#072d1d] transition">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-medium truncate">${r.name}</h4>
                        <span class="text-[11px] opacity-80">⭐ ${r.stargazers_count}</span>
                    </div>
                    <p class="text-xs opacity-80 mt-1 line-clamp-2">${r.description ?? ""}</p>
                    <p class="text-[10px] opacity-60 mt-2">${r.language ?? ""}</p>
                </a>
        `
            )
            .join("");
    } catch (e) {
        const mount = document.getElementById("repo-list");
        if (mount) mount.innerHTML = `<div class="text-xs opacity-70">Fehler beim Laden.</div>`;
        console.error(e);
    }
}
window.addEventListener("load", fetchRepos);
document.addEventListener("click", (e) => {
    if ((e.target)?.id === "refresh-repos") {
        fetchRepos();
    }
});
