@extends('layouts.app')

@section('content')
    <section class="py-10 lg:py-14">
        <div class="flex items-start gap-6">
            <img src="https://avatars.githubusercontent.com/u/11487003?v=4" alt="Avatar" class="w-16 h-16 rounded-full border border-[#00ff7f66]"/>
            <div>
                <h1 class="text-3xl lg:text-4xl mb-1">
                    <span class="text-[#7ee7b5]">Benjamin Gayda-Knopl</span>
                    <span class="opacity-70">— RaxoTheOne</span>
                </h1>
                <p class="text-[#7ee7b5] text-sm">31 Jahre alt, Vater von drei Mädchen, glücklich verheiratet, angehender Fachinformatiker für Anwendungsentwicklung</p>
                <div class="mt-3 text-xs opacity-80 flex items-center gap-4">
                    <span>⭐ 2 stars</span>
                    <span>🍴 0 forks</span>
                    <span>&lt;/&gt; 73 Repos</span>
                </div>
                <a href="#projects" class="inline-block mt-4 px-4 py-1 bg-[#00ff7f] text-black rounded-sm border border-[#00ff7f] hover:bg-[#7ee7b5] transition">View My Work</a>
            </div>
        </div>
    </section>

    <section class="py-6">
        <div class="flex text-xs border border-[#00ff7f33] rounded-sm overflow-hidden">
            <button class="tab-btn flex-1 px-4 py-2 bg-[#072d1d]" data-tab="about">About</button>
            <button class="tab-btn flex-1 px-4 py-2 border-l border-[#00ff7f33]" data-tab="projects">Projects</button>
            <button class="tab-btn flex-1 px-4 py-2 border-l border-[#00ff7f33]" data-tab="skills">Skills</button>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-4">
            <div class="tab-panel border border-[#00ff7f33] rounded-sm p-4 bg-black/40" id="about">
                <h3 class="text-sm mb-2 opacity-90">About Me</h3>
                <p class="text-[#7ee7b5] text-sm leading-normal opacity-90">
                    Ich liebe es, an verschiedenen Projekten zu arbeiten und neue Technologien zu lernen.
                    Mein Ziel ist es, als Full‑Stack‑Entwickler zu arbeiten und innovative Lösungen zu entwickeln.
                </p>
            </div>
            <div class="tab-panel hidden border border-[#00ff7f33] rounded-sm p-4 bg-black/40" id="projects">
                <h3 class="text-sm mb-2 opacity-90">GitHub Stats</h3>
                <ul class="text-xs space-y-1 opacity-80">
                    <li>Total Stars: 2</li>
                    <li>Total Forks: 0</li>
                    <li>Languages: 8</li>
                    <li>Account Age: 729 days</li>
                    <li>Most Used: Python</li>
                </ul>
            </div>
            <div class="tab-panel hidden border border-[#00ff7f33] rounded-sm p-4 bg-black/40" id="skills">
                <h3 class="text-sm mb-2 opacity-90">Contact Info</h3>
                <ul class="text-xs space-y-1 opacity-80">
                    <li>GitHub: RaxoTheOne</li>
                    <li>E-Mail: traxon.bgg@gmail.com</li>
                    <li>Ort: Berlin</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="contact" class="py-10">
        <p class="text-xs opacity-70">© {{ date('Y') }} Benjamin Gayda-Knopl — Portfolio mit Matrix‑Effekt</p>
    </section>
@endsection
