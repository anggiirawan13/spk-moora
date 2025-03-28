<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use Illuminate\Http\Request;

class CarTypeController extends Controller {
    public function index() {
        $carTypes = CarType::all();
        return view('admin.car_type.index', compact('carTypes'));
    }

    public function create() {
        return view('admin.car_type.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:car_types']);
        CarType::create($request->all());
        return redirect()->route('admin.car_type.index')->with('success', 'Jenis car berhasil ditambahkan!');
    }

    public function show($id)
    {
        $carType = CarType::findOrFail($id);
        return view('admin.car_type.show', compact('carType'));
    }

    public function edit(CarType $carType) {
        return view('admin.car_type.edit', compact('carType'));
    }

    public function update(Request $request, CarType $carType) {
        $request->validate(['name' => 'required|unique:car_types,name,' . $carType->id]);
        $carType->update($request->all());
        return redirect()->route('admin.car_type.index')->with('success', 'Jenis car berhasil diperbarui!');
    }

    public function destroy(CarType $carType) {
        $carType->delete();
        return redirect()->route('admin.car_type.index')->with('success', 'Jenis car berhasil dihapus!');
    }
}
