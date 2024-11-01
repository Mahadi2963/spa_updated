<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\Mark;

class AdminController extends Controller
{
    public function verifyUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_verified = true;
        $user->save();

        return redirect()->back()->with('message', 'User verified successfully.');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage_users', compact('users'));
    }

    public function addSubject(Request $request)
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
        return redirect()->back()->with('message', 'Subject added successfully.');
    }

    public function manageMarks()
    {
        $marks = Mark::all();
        return view('admin.manage_marks', compact('marks'));
    }

    public function updateMark(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subject' => 'nullable|string',
            'predicted_marks' => 'nullable|numeric',
            'final_grade' => 'nullable|string',
            'present_count' => 'required|integer',
            'absent_count' => 'required|integer',
            'classTest_1' => 'required|numeric',
            'Lab_Test1' => 'required|numeric',
            'mid_mark' => 'required|numeric',
            'classTest_2' => 'required|numeric',
            'Lab_Test2' => 'required|numeric',
            'assignment' => 'required|numeric',
            'External_activity' => 'required|numeric',
            'recommendations' => 'nullable|string',
        ]);

        $mark = Mark::findOrFail($id);
        $mark->update($validatedData);

        return redirect()->back()->with('message', 'Mark updated successfully.');
    }

    public function dashboard()
    {
        return view('dashboard.admin');
    }
}
