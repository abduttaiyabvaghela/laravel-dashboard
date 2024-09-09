<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('type', 'user')->get();
        return view('admin.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'type' => 'required|in:admin,user',
            'status' => 'required|boolean',
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.index')->with('success', 'User details have been updated.');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }
}

