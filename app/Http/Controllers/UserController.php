<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'role' => 'required|string',
            'password' => 'required|min:8'
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password) // Hashing password sebelum menyimpan
        ]);

        return redirect('/users')->with('sukses', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required|unique:users,name,' . $user->id,
            'email' => 'required|unique:users,email,' . $user->id . '|email',
            'role' => 'required|string',
            'password' => 'nullable|min:8'
        ]);

        // Update data user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update password jika ada input password baru
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/users')->with('sukses', 'User berhasil diubah');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('sukses', 'User berhasil dihapus');
    }
}