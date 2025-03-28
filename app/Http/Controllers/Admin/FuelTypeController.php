<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuelType;
use Illuminate\Http\Request;

class FuelTypeController extends Controller {
    public function index() {
        $fuelTypes = FuelType::all();
        return view('admin.fuel_type.index', compact('fuelTypes'));
    }

    public function create() {
        return view('admin.fuel_type.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:fuel_types']);
        FuelType::create($request->all());
        return redirect()->route('admin.fuel_type.index')->with('success', 'Bahan bakar berhasil ditambahkan!');
    }

    public function show($id)
    {
        $fuelType = FuelType::findOrFail($id);
        return view('admin.fuel_type.show', compact('fuelType'));
    }

    public function edit(FuelType $fuelType) {
        return view('admin.fuel_type.edit', compact('fuelType'));
    }

    public function update(Request $request, FuelType $fuelType) {
        $request->validate(['name' => 'required|unique:fuel_types,name,' . $fuelType->id]);
        $fuelType->update($request->all());
        return redirect()->route('admin.fuel_type.index')->with('success', 'Bahan bakar berhasil diperbarui!');
    }

    public function destroy(FuelType $fuelType) {
        $fuelType->delete();
        return redirect()->route('admin.fuel_type.index')->with('success', 'Bahan bakar berhasil dihapus!');
    }
}
