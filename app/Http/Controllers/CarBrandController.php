<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller {
    public function index() {
        $carBrands = CarBrand::all();
        return view('admin.car_brands.index', compact('carBrands'));
    }

    public function create() {
        return view('admin.car_brands.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:car_brands']);
        CarBrand::create($request->all());
        return redirect()->route('admin.car_brands.index')->with('success', 'Merek mobil berhasil ditambahkan!');
    }

    public function edit(CarBrand $carBrand) {
        return view('admin.car_brands.edit', compact('carBrand'));
    }

    public function update(Request $request, CarBrand $carBrand) {
        $request->validate(['name' => 'required|unique:car_brands,name,' . $carBrand->id]);
        $carBrand->update($request->all());
        return redirect()->route('admin.car_brands.index')->with('success', 'Merek mobil berhasil diperbarui!');
    }

    public function destroy(CarBrand $carBrand) {
        $carBrand->delete();
        return redirect()->route('admin.car_brands.index')->with('success', 'Merek mobil berhasil dihapus!');
    }
}
