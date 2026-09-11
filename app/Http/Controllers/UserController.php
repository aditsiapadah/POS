<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->role_id != 1) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Kasir tidak bisa melihat halaman Users.');
        }

        return null;
    }

    public function index(Request $request)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $search = $request->search;

        $users = User::with('role')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id'  => 'required',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('users', 'public');
        }

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,
            'foto'     => $foto,
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $user->foto = $request->file('foto')->store('users', 'public');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('admin.users')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        if (Auth::id() == $user->id) {
            return redirect()
                ->route('admin.users')
                ->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
        }

        if ($user->produk()->exists()) {
            return redirect()
                ->route('admin.users')
                ->with('error', 'User tidak dapat dihapus karena masih memiliki data produk.');
        }

        if ($user->penjualan()->exists()) {
            return redirect()
                ->route('admin.users')
                ->with('error', 'User tidak dapat dihapus karena masih memiliki data penjualan.');
        }

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'Data user berhasil dihapus.');
    }
}
