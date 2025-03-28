<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransmissionType;
use Illuminate\Http\Request;

class TransmissionTypeController extends Controller {
    public function index() {
        $transmissionTypes = TransmissionType::all();
        return view('admin.transmission_type.index', compact('transmissionTypes'));
    }

    public function create() {
        return view('admin.transmission_type.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:transmission_types']);
        TransmissionType::create($request->all());
        return redirect()->route('admin.transmission_type.index')->with('success', 'Tipe transmisi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $transmissionType = TransmissionType::findOrFail($id);
        return view('admin.transmission_type.show', compact('transmissionType'));
    }

    public function edit(TransmissionType $transmissionType) {
        return view('admin.transmission_type.edit', compact('transmissionType'));
    }

    public function update(Request $request, TransmissionType $transmissionType) {
        $request->validate(['name' => 'required|unique:transmission_types,name,' . $transmissionType->id]);
        $transmissionType->update($request->all());
        return redirect()->route('admin.transmission_type.index')->with('success', 'Tipe transmisi berhasil diperbarui!');
    }

    public function destroy(TransmissionType $transmissionType) {
        $transmissionType->delete();
        return redirect()->route('admin.transmission_type.index')->with('success', 'Tipe transmisi berhasil dihapus!');
    }
}
