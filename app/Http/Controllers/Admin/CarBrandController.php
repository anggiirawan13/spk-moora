<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller {
    public function index() {
        $carBrands = CarBrand::all();
        return view('admin.car_brand.index', compact('carBrands'));
    }

    public function create() {
        return view('admin.car_brand.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:car_brands']);
        CarBrand::create($request->all());
        return redirect()->route('admin.car_brand.index')->with('success', 'Merek car berhasil ditambahkan!');
    }

    public function show($id)
    {
        $carBrand = CarBrand::findOrFail($id);
        return view('admin.car_brand.show', compact('carBrand'));
    }

    public function edit(CarBrand $carBrand) {
        return view('admin.car_brand.edit', compact('carBrand'));
    }

    public function update(Request $request, CarBrand $carBrand) {
        $request->validate(['name' => 'required|unique:car_brands,name,' . $carBrand->id]);
        $carBrand->update($request->all());
        return redirect()->route('admin.car_brand.index')->with('success', 'Merek car berhasil diperbarui!');
    }

    public function destroy(CarBrand $carBrand) {
        $carBrand->delete();
        return redirect()->route('admin.car_brand.index')->with('success', 'Merek car berhasil dihapus!');
    }
}
