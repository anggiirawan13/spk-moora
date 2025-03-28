<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CriteriaController extends Controller
{
    public function index(): View
    {
        $criteria = Criteria::orderby('kode', 'asc')->get();
        return view('admin.criteria.index', compact('criteria'));
    }

    public function create(): View
    {
        return view('admin.criteria.create');

    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'kode' => 'required',
            'name' => 'required',
            'weight' => 'required',
            'atribut' => 'required'
        ]);

        $criteria = Criteria::create([
            'kode' => $request->kode,
            'name' => $request->name,
            'weight' => $request->weight,
            'atribut' => $request->atribut,
        ]);

        return redirect()->back()->with('success','Data berhasil disimpan');
    }

    public function show($id)
    {
        $criteria = Criteria::findOrFail($id);
        return view('admin.criteria.show', compact('criteria'));
    }

    public function edit($id): View
    {
        $criteria = Criteria::findorfail($id);
        return view('admin.criteria.edit', compact('criteria'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'kode' => 'required',
            'name' => 'required',
            'weight' => 'required',
            'atribut' => 'required',
        ]);

        $criteria = [
            'kode' => $request->kode,
            'name' => $request->name,
            'weight' => $request->weight,
            'atribut' => $request->atribut,
        ];

        Criteria::whereId($id)->update($criteria);

        return redirect()->route('criteria.index')->with('success','Data Berhasil di Update');
    }

    public function destroy($id): RedirectResponse
    {
        $criteria = Criteria::findorfail($id);
        $criteria->delete();

        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
