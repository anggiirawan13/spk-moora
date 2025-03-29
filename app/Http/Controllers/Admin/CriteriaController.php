<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criteria;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Database\QueryException;

class CriteriaController extends Controller
{
    public function index(): View
    {
        $criterias = Criteria::orderby('code', 'asc')->get();

        $criterias->transform(function ($c) {
            return [
                'id' => $c->id,
                'code' => $c->code,
                'name' => $c->name,
                'weight' => $c->weight,
                'attribute_type' => ucwords(str_replace('_', ' ', $c->attribute_type)),
            ];
        });

        return view('admin.criteria.index', compact('criterias'));
    }

    public function create(): View
    {
        $maxWeight = 1 - Criteria::sum('weight');
        return view('admin.criteria.create', compact('maxWeight'));
    }

    public function show($id)
    {
        $criteria = Criteria::findOrFail($id);
        return view('admin.criteria.show', compact('criteria'));
    }

    public function edit($id)
    {
        $criteria = Criteria::findorfail($id);
        $maxWeight = 1 - (Criteria::sum('weight') - $criteria->weight);
        return view('admin.criteria.edit', compact('criteria', 'maxWeight'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:criterias,code', // Tambahkan validasi unique di sini
            'name' => 'required',
            'weight' => 'required|numeric',
            'attribute_type' => 'required'
        ]);

        try {
            Criteria::create([
                'code' => $request->code,
                'name' => $request->name,
                'weight' => $request->weight,
                'attribute_type' => $request->attribute_type,
            ]);

            return redirect()->route('criteria.index')->with('success', 'Data Berhasil Disimpan');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 10062) {
                return back()->withInput()->with('error', 'Kode sudah digunakan, gunakan kode lain.');
            }

            return back()->withInput()->with('error', 'Terjadi kesalahan, coba lagi.');
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'weight' => 'required',
            'attribute_type' => 'required',
        ]);

        try {
            $criteria = [
                'code' => $request->code,
                'name' => $request->name,
                'weight' => $request->weight,
                'attribute_type' => $request->attribute_type,
            ];

            Criteria::whereId($id)->update($criteria);

            return redirect()->route('criteria.index')->with('success', 'Data Berhasil Diubah');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 10062) {
                return back()->withInput()->with('error', 'Kode sudah digunakan, gunakan kode lain.');
            }

            return back()->withInput()->with('error', 'Terjadi kesalahan, coba lagi.');
        }
    }

    public function destroy($id): RedirectResponse
    {
        $criteria = Criteria::findorfail($id);
        $criteria->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }
}
