<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // الدالة المفقودة لعرض صفحة الإضافة
    public function create()
    {
        return view('admin.users.create');
    }

    // الدالة الخاصة بحفظ المستخدم الجديد
    public function store(Request $request)
    {
$request->validate([
    'name'     => 'required|string|max:255',
    'email'    => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:8',
    'role'     => 'required|in:User,Admin,user,admin', 
]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => strtolower($request->role),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'  => 'required|string',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}