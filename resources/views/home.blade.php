@extends('layouts.app')

@section('content')
    <section class="py-16 lg:py-24">
        <div class="max-w-3xl">
            <h1 class="text-4xl lg:text-6xl font-medium mb-4">Ich baue moderne, performante Web-Erlebnisse.</h1>
            <p class="text-[#706f6c] dark:text-[#A1A09A] text-lg leading-normal mb-8">
                Saubere Architektur, gutes UX und ein Auge fürs Detail – inspiriert vom Look der Referenzseite
                (<a href="https://coder-journey-3.preview.emergentagent.com/" class="underline underline-offset-4 text-[#f53003] dark:text-[#FF4433]" target="_blank">Link</a>).
            </p>
            <div class="flex gap-3">
                <a href="#work" class="inline-block px-5 py-2 bg-[#1b1b18] text-white rounded-sm border border-black hover:bg-black hover:border-black">Projekte ansehen</a>
                <a href="#contact" class="inline-block px-5 py-2 border border-[#19140035] hover:border-[#1915014a] rounded-sm">Kontakt</a>
            </div>
        </div>
    </section>

    <section id="work" class="py-12 border-t border-[#19140035] dark:border-[#3E3E3A]">
        <h2 class="text-2xl font-medium mb-6">Ausgewählte Arbeiten</h2>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @foreach (range(1,3) as $i)
                <article class="rounded-sm shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] p-6 bg-white dark:bg-[#161615]">
                    <div class="aspect-[335/200] bg-[#dbdbd7] dark:bg-[#3E3E3A] rounded-sm mb-4"></div>
                    <h3 class="font-medium mb-1">Projekt {{ $i }}</h3>
                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Kurze Beschreibung des Projekts mit Fokus auf Ergebnisse.</p>
                </article>
            @endforeach
        </div>
    </section>

    <section id="about" class="py-12">
        <h2 class="text-2xl font-medium mb-4">Über mich</h2>
        <p class="text-[#706f6c] dark:text-[#A1A09A] max-w-2xl">Ich kombiniere Laravel im Backend mit modernen Frontend-Stacks, um hochwertige Produkte zu liefern.</p>
    </section>

    <section id="contact" class="py-12 border-t border-[#19140035] dark:border-[#3E3E3A]">
        <h2 class="text-2xl font-medium mb-4">Kontakt</h2>
        <p class="text-[#706f6c] dark:text-[#A1A09A]">Schreib mir: <a href="mailto:hi@example.com" class="underline">hi@example.com</a></p>
    </section>
@endsection


