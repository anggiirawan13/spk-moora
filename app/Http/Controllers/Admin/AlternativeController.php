<?php

namespace App\Http\Controllers\Admin;

use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\AlternativeValue;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $kriteria = Criteria::orderBy('id', 'asc')->get();
        $alternatif = Alternative::with('values')->orderBy('created_at', 'asc')->get();
        
        return view('admin.alternatif.index', compact('kriteria', 'alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kriteria = Criteria::orderBy('id', 'asc')->get();
        return view('admin.alternatif.create', compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $kriteria = Criteria::all();

        // Validasi dinamis sesuai jumlah kriteria
        $rules = ['nama' => 'required'];
        foreach ($kriteria as $k) {
            $rules["nilai_{$k->id}"] = 'required|numeric';
        }

        $request->validate($rules);

        // Simpan alternatif
        $alternatif = Alternative::create([
            'nama' => $request->nama,
        ]);

        // Simpan nilai alternatif berdasarkan kriteria
        foreach ($kriteria as $k) {
            AlternativeValue::create([
                'alternative_id' => $alternatif->id,
                'criteria_id' => $k->id,
                'nilai' => $request->input("nilai_{$k->id}"),
            ]);
        }

        return redirect()->route('alternatif.index')->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        $alternatif = Alternative::with('values.criteria')->findOrFail($id);
        return view('admin.alternatif.show', compact('alternatif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $alternatif = Alternative::findOrFail($id);
        $kriteria = Criteria::orderBy('id', 'asc')->get();
        $nilaiAlternatif = AlternativeValue::where('alternative_id', $id)->pluck('nilai', 'criteria_id');

        return view('admin.alternatif.edit', compact('alternatif', 'kriteria', 'nilaiAlternatif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $alternatif = Alternative::findOrFail($id);
        $kriteria = Criteria::all();

        // Validasi dinamis sesuai jumlah kriteria
        $rules = ['nama' => 'required'];
        foreach ($kriteria as $k) {
            $rules["nilai_{$k->id}"] = 'required|numeric';
        }
        $request->validate($rules);

        // Update alternatif
        $alternatif->update(['nama' => $request->nama]);

        // Update atau buat nilai alternatif
        foreach ($kriteria as $k) {
            AlternativeValue::updateOrCreate(
                [
                    'alternative_id' => $alternatif->id,
                    'criteria_id' => $k->id,
                ],
                ['nilai' => $request->input("nilai_{$k->id}")]
            );
        }

        return redirect()->route('alternatif.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $alternatif = Alternative::findOrFail($id);

        // Hapus nilai terkait
        AlternativeValue::where('alternative_id', $id)->delete();

        // Hapus alternatif
        $alternatif->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
