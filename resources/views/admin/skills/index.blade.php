@extends('layouts.app')

@section('content')
    <section class="py-8 pt-12">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl">Skills</h1>
            <a href="{{ route('admin.skills.create') }}" class="px-3 py-1 border border-[#00ff7f66] rounded-sm">Neu</a>
        </div>
        @if (session('ok'))
            <div class="mb-3 text-xs text-black bg-[#7ee7b5] inline-block px-2 py-1 rounded">{{ session('ok') }}</div>
        @endif
        <div class="overflow-x-auto border border-[#00ff7f33] rounded-sm">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-black/40">
                        <th class="p-2">#</th>
                        <th class="p-2">Name</th>
                        <th class="p-2">Category</th>
                        <th class="p-2">Level</th>
                        <th class="p-2">Order</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skills as $s)
                        <tr class="border-t border-[#00ff7f22]">
                            <td class="p-2">{{ $s->id }}</td>
                            <td class="p-2">{{ $s->name }}</td>
                            <td class="p-2">{{ $s->category }}</td>
                            <td class="p-2">{{ $s->level }}%</td>
                            <td class="p-2">{{ $s->order }}</td>
                            <td class="p-2">
                                <a class="underline" href="{{ route('admin.skills.edit', $s) }}">Bearbeiten</a>
                                <form action="{{ route('admin.skills.destroy', $s) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Wirklich löschen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 underline">Löschen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection


