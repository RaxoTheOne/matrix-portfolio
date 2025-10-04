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
async function fetchGitHubStats() {
    try {
        const username =
            document
                .querySelector("[data-username]")
                ?.getAttribute("data-username") || "RaxoTheOne";
        const res = await fetch(
            `/github/stats?username=${encodeURIComponent(username)}`
        );
        if (!res.ok) return;
        const data = await res.json();
        document.querySelectorAll("[data-stat]")?.forEach((el) => {
            const key = el.getAttribute("data-stat");
            if (data[key] !== undefined && data[key] !== null) {
                el.textContent = data[key];
            }
        });
        const mountLang = document.getElementById("lang-bars");
        if (mountLang && data.languages_map) {
            const entries = Object.entries(data.languages_map);
            const total =
                data.languages_total || entries.reduce((s, [, c]) => s + c, 0);
            mountLang.innerHTML = entries
                .map(([lang, count]) => {
                    const pct = total ? Math.round((count / total) * 100) : 0;
                    return `
                        <div class="text-xs flex items-center justify-between">
                            <span>${lang}</span><span>${count} · ${pct}%</span>
                        </div>
                        <div class="h-2 bg-black/40 border border-[#00ff7f33] rounded-sm">
                            <div class="h-2 bg-[#00ff7f]" style="width:${pct}%"></div>
                        </div>
                    `;
                })
                .join("");
        }
    } catch (e) {
        // ignore silently
    }
}
window.addEventListener("load", fetchGitHubStats);

async function fetchRepos() {
    try {
        const username =
            document
                .querySelector("[data-username]")
                ?.getAttribute("data-username") || "RaxoTheOne";
        const res = await fetch(
            `/github/repos?username=${encodeURIComponent(username)}&limit=24`
        );
        if (!res.ok) return;
        const repos = await res.json();
        const mount = document.getElementById("repo-list");
        if (!mount) return;
        mount.innerHTML = repos
            .map(
                (r) => `
                <a href="${r.html_url}" target="_blank"
                    class="block border border-[#00ff7f33] rounded-sm p-3 bg-black/40 hover:bg-[#072d1d] transition">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm">${r.name}</h4>
                        <span class="text-xs opacity-80">⭐ ${
                            r.stargazers_count
                        }</span>
                    </div>
                    <p class="text-xs opacity-80 mt-1">${
                        r.description ?? ""
                    }</p>
                    <p class="text-[10px] opacity-60 mt-1">${
                        r.language ?? ""
                    }</p>
                </a>
        `
            )
            .join("");
    } catch (e) {}
}
window.addEventListener("load", fetchRepos);
