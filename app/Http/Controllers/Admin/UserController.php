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
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $mobil): View
    {
        return view('admin.user.edit', compact('mobil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarUpdateRequest $request, Car $mobil): RedirectResponse
    {
        if ($request->validated()) {
            $slug = Str::slug($request->nama, '-');
            $dataUpdate = $request->except('gambar') + ['slug' => $slug];

            if ($request->hasFile('gambar')) {
                if ($mobil->gambar) {
                    Storage::delete('public/car/' . $mobil->gambar);
                }

                $gambar = $request->file('gambar')->store('car', 'public');
                $gambarName = basename($gambar);

                $dataUpdate['gambar'] = $gambarName;
            }

            $mobil->update($dataUpdate);
        }

        return redirect()->route('user.index')->with([
            'message' => 'Data Berhasil Diubah',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $mobil): RedirectResponse
    {
        if($mobil->gambar){
            unlink('storage/' . $mobil->gambar);
        }
        $mobil->delete();
        return redirect()->back()->with([
            'message'=> 'Data Berhasil DiHapus',
            'alert-type' => 'danger'
        ]);
    }

}
