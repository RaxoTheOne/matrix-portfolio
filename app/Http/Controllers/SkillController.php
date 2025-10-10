<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')->orderBy('order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'level' => 'nullable|integer|min:0|max:100',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);
        Skill::create($data);
        return redirect()->route('admin.skills.index')->with('ok', 'Skill angelegt');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'level' => 'nullable|integer|min:0|max:100',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);
        $skill->update($data);
        return redirect()->route('admin.skills.index')->with('ok', 'Skill aktualisiert');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('ok', 'Skill gelöscht');
    }
}
