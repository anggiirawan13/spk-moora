<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $kriteria = Criteria::orderby('kode', 'asc')->get();
        return view('admin.kriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.kriteria.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'bobot' => 'required',
            'atribut' => 'required'
        ]);

        $kriteria = Criteria::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'bobot' => $request->bobot,
            'atribut' => $request->atribut,
        ]);

        return redirect()->back()->with('success','Data berhasil disimpan');
    }

    public function show($id)
    {
        $kriteria = Criteria::findOrFail($id);
        return view('admin.kriteria.show', compact('kriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $kriteria = Criteria::findorfail($id);
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'bobot' => 'required',
            'atribut' => 'required',
        ]);

        $kriteria = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'bobot' => $request->bobot,
            'atribut' => $request->atribut,
        ];

        Criteria::whereId($id)->update($kriteria);

        return redirect()->route('kriteria.index')->with('success','Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $kriteria = Criteria::findorfail($id);
        $kriteria->delete();

        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
