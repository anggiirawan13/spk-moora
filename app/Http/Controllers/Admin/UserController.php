<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\CarUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $users = User::where('id', '!=', Auth::id())->latest()->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        // Konversi role ke angka (1 untuk admin, 0 untuk user)
        $roleValue = strtolower($validatedData['role']) === strtolower('admin') ? 1 : 0;

        // Simpan data user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Enkripsi password
            'is_admin' => $roleValue, // Simpan sebagai 1 atau 0
        ]);

        // Redirect ke halaman user dengan pesan sukses
        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        // Ambil user berdasarkan ID
        $user = User::findOrFail($id);

        // Ubah role menjadi 1 jika admin, 0 jika user
        $validatedData['is_admin'] = $validatedData['role'] === 'admin' ? 1 : 0;
        unset($validatedData['role']); // Hapus 'role' agar tidak menyebabkan error

        // Periksa apakah password diubah atau tidak
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Jika password tidak diisi, jangan ubah
        }

        // Update data user
        $user->update($validatedData);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->back()->with([
            'message'=> 'Data Berhasil DiHapus',
            'alert-type' => 'danger'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Pastikan user sedang login

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        
        // Periksa apakah password diubah atau tidak
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Jika password kosong, jangan diubah
        }

        // Update profil user
        $user->update($validatedData);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
