@extends('layouts.app')

@section('content')
    <section class="py-8 max-w-3xl pt-12">
        <h1 class="text-xl mb-4">Neues Projekt</h1>
        <form method="POST" action="{{ route('admin.projects.store') }}" class="space-y-3">
            @csrf
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="title" placeholder="Title" required />
            <textarea class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="description" placeholder="Description" required></textarea>
            <textarea class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="long_description" placeholder="Long description"></textarea>
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="image" placeholder="Image URL" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="github_url" placeholder="GitHub URL" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="demo_url" placeholder="Demo URL" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="technologies" placeholder='Technologies (JSON z.B. ["PHP","Laravel"])' />
            <label class="text-xs flex items-center gap-2"><input type="checkbox" name="featured" value="1"> Featured</label>
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="order" placeholder="Order (Zahl)" />
            <div class="pt-2">
                <button class="px-3 py-1 border border-[#00ff7f66] rounded-sm">Speichern</button>
                <a class="ml-2 underline" href="{{ route('admin.projects.index') }}">Abbrechen</a>
            </div>
        </form>
    </section>
@endsection


