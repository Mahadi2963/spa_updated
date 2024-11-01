<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:subjects,name',
            'teacher_id' => 'nullable|exists:teachers,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images/subjects', 'public');
        }

        Subject::create($validatedData);
        return redirect()->back()->with('message', 'Subject created successfully.');
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|unique:subjects,name,' . $subject->id,
            'teacher_id' => 'nullable|exists:teachers,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images/subjects', 'public');
        }

        $subject->update($validatedData);
        return redirect()->back()->with('message', 'Subject updated successfully.');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->back()->with('message', 'Subject deleted successfully.');
    }
}
