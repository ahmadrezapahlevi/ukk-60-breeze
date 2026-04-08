<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $r)
    {
        $q = $r->get('q');

        $users = User::query()
            ->where('role', 'siswa')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('username', 'like', "%{$q}%")
                        ->orWhere('kelas', 'like', "%{$q}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'q'));
    }

    public function create()
    {
        return view('admin.users.form', [
            'mode' => 'create',
            'user' => new User(),
        ]);
    }

    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:20|unique:users,username',
            'kelas' => 'required|max:10',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $r->name,
            'username' => $r->username,
            'role' => 'siswa',
            'kelas' => $r->kelas,
            'password' => Hash::make($r->password),
        ]);

        return redirect('/admin/users')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function show(User $user)
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        return view('admin.users.form', [
            'mode' => 'edit',
            'user' => $user,
        ]);
    }

    public function update(Request $r, User $user)
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        $r->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:20|unique:users,username,' . $user->id,
            'kelas' => 'required|max:10',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $r->name,
            'username' => $r->username,
            'kelas' => $r->kelas,
            'role' => 'siswa',
        ];

        if ($r->filled('password')) {
            $data['password'] = Hash::make($r->password);
        }

        $user->update($data);

        return redirect('/admin/users')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'siswa') {
            return back()->with('error', 'Hanya data siswa yang bisa dihapus dari menu ini');
        }

        if ($user->id == auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun yang sedang login');
        }

        $user->delete();

        return back()->with('success', 'Data siswa berhasil dihapus');
    }
}
