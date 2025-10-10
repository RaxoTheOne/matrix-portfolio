@extends('layouts.app')

@section('content')
    <section class="py-8 max-w-3xl">
        <h1 class="text-xl mb-4">Skill bearbeiten</h1>
        <form method="POST" action="{{ route('admin.skills.update', $skill) }}" class="space-y-3">
            @csrf
            @method('PUT')
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="name" value="{{ old('name', $skill->name) }}" required />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="category" value="{{ old('category', $skill->category) }}" required />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="level" value="{{ old('level', $skill->level) }}" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="icon" value="{{ old('icon', $skill->icon) }}" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="color" value="{{ old('color', $skill->color) }}" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="order" value="{{ old('order', $skill->order) }}" />
            <div class="pt-2">
                <button class="px-3 py-1 border border-[#00ff7f66] rounded-sm">Speichern</button>
                <a class="ml-2 underline" href="{{ route('admin.skills.index') }}">Abbrechen</a>
            </div>
        </form>
    </section>
@endsection


