<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\CarStoreRequest;
use App\Http\Requests\Admin\CarUpdateRequest;
use App\Models\CarBrand;
use App\Models\CarType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
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
        $mereks = CarBrand::all();
        $jenis_mobils = CarType::all();

        return view('admin.mobil.create',compact('mereks', 'jenis_mobils'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarStoreRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $gambar = $request->file('gambar')->store('car', 'public');
            $gambarName = basename($gambar);

            $slug = Str::slug($request->nama, '-');

            Car::create($request->except('gambar') + ['gambar' => $gambarName, 'slug' => $slug]);
        }

        return redirect()->route('mobil.index')->with([
            'message' => 'Data Berhasil Ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function show($id)
    {
        $mobil = Car::with(['carBrand', 'carType'])->findOrFail($id);
        return view('admin.mobil.show', compact('mobil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $mobil): View
    {
        $mereks = CarBrand::all();
        $jenis_mobils = CarType::all();

        return view('admin.mobil.show', compact('mobil', 'mereks', 'jenis_mobils'));
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

        return redirect()->route('mobil.index')->with([
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
