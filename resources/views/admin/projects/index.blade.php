@extends('layouts.app')

@section('content')
    <section class="py-8">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl">Projects</h1>
            <a href="{{ route('admin.projects.create') }}" class="px-3 py-1 border border-[#00ff7f66] rounded-sm">Neu</a>
        </div>
        @if (session('ok'))
            <div class="mb-3 text-xs text-black bg-[#7ee7b5] inline-block px-2 py-1 rounded">{{ session('ok') }}</div>
        @endif
        <div class="overflow-x-auto border border-[#00ff7f33] rounded-sm">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-black/40">
                        <th class="p-2">#</th>
                        <th class="p-2">Title</th>
                        <th class="p-2">Featured</th>
                        <th class="p-2">Order</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $p)
                        <tr class="border-t border-[#00ff7f22]">
                            <td class="p-2">{{ $p->id }}</td>
                            <td class="p-2">{{ $p->title }}</td>
                            <td class="p-2">{{ $p->featured ? 'yes' : 'no' }}</td>
                            <td class="p-2">{{ $p->order }}</td>
                            <td class="p-2">
                                <a class="underline" href="{{ route('admin.projects.edit', $p) }}">Bearbeiten</a>
                                <form action="{{ route('admin.projects.destroy', $p) }}" method="POST" class="inline"
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
        <div class="mt-3">{{ $projects->links() }}</div>
    </section>
@endsection