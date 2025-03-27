<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use Illuminate\Http\Request;

class CarTypeController extends Controller {
    public function index() {
        $carTypes = CarType::all();
        return view('admin.car_types.index', compact('carTypes'));
    }

    public function create() {
        return view('admin.car_types.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:car_types']);
        CarType::create($request->all());
        return redirect()->route('admin.car_types.index')->with('success', 'Jenis mobil berhasil ditambahkan!');
    }

    public function edit(CarType $carType) {
        return view('admin.car_types.edit', compact('carType'));
    }

    public function update(Request $request, CarType $carType) {
        $request->validate(['name' => 'required|unique:car_types,name,' . $carType->id]);
        $carType->update($request->all());
        return redirect()->route('admin.car_types.index')->with('success', 'Jenis mobil berhasil diperbarui!');
    }

    public function destroy(CarType $carType) {
        $carType->delete();
        return redirect()->route('admin.car_types.index')->with('success', 'Jenis mobil berhasil dihapus!');
    }
}
