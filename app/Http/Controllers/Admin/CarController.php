<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\CarStoreRequest;
use App\Http\Requests\Admin\CarUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $mobils = Car::latest()->get();
        return view('admin.mobil.index', compact('mobils'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarStoreRequest $request,): RedirectResponse
    {
        if($request->validated()){
            $gambar = $request->file('gambar')->store('assets/mobil', 'public');
            $slug = Str::slug($request->nama,'-');

            Car::create($request->except('gambar') + ['gambar'=> $gambar, 'slug' => $slug]);
        }
        return redirect()->route('mobil.index')->with([
            'message'=> 'Data Berhasil DiTambahkan',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $mobil): View
    {
        return view('admin.mobil.edit', compact('mobil'));
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
        if($request->validated()){
            $slug = Str::slug($request->nama,'-');
            $mobil->update($request->validated()+['slug'=> $slug]);
        }
        return redirect()->route('mobil.index')->with([
            'message'=> 'Data Berhasil DiEdit',
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
