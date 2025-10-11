@extends('layouts.app')

@section('content')
    <section class="py-8 max-w-3xl pt-12">
        <h1 class="text-xl mb-4">Neuer Skill</h1>
        <form method="POST" action="{{ route('admin.skills.store') }}" class="space-y-3">
            @csrf
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="name" placeholder="Name" required />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="category" placeholder="Category" required />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="level" placeholder="Level (0-100)" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="icon" placeholder="Icon" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="color" placeholder="Color (Hex)" />
            <input class="w-full p-2 bg-black/40 border border-[#00ff7f33]" name="order" placeholder="Order (Zahl)" />
            <div class="pt-2">
                <button class="px-3 py-1 border border-[#00ff7f66] rounded-sm">Speichern</button>
                <a class="ml-2 underline" href="{{ route('admin.skills.index') }}">Abbrechen</a>
            </div>
        </form>
    </section>
@endsection


