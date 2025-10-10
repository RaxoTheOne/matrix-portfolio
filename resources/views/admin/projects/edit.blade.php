@extends('layouts.app')

@section('content')
    <section class="py-8 max-w-3xl">
        <h1 class="text-xl mb-4">Projekt bearbeiten</h1>
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" class="space-y-3">
            @csrf
            @method('PUT')
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="title" value="{{ old('title', $project->title) }}" required />
            <textarea class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="description" required>{{ old('description', $project->description) }}</textarea>
            <textarea class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="long_description">{{ old('long_description', $project->long_description) }}</textarea>
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="image" value="{{ old('image', $project->image) }}" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="github_url" value="{{ old('github_url', $project->github_url) }}" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="technologies" value='{{ old('technologies', json_encode($project->technologies)) }}' />
            <label class="text-xs flex items-center gap-2"><input type="checkbox" name="featured" value="1" {{ $project->featured ? 'checked' : '' }}> Featured</label>
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="order" value="{{ old('order', $project->order) }}" />
            <div class="pt-2">
                <button class="px-3 py-1 border border-[#00ff7f66] rounded-sm">Speichern</button>
                <a class="ml-2 underline" href="{{ route('admin.projects.index') }}">Abbrechen</a>
            </div>
        </form>
    </section>
@endsection


