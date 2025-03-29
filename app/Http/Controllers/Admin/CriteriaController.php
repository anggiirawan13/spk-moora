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
        $criterias = Criteria::orderby('code', 'asc')->get();
        return view('admin.criteria.index', compact('criterias'));
    }

    public function create(): View
    {
        $maxWeight = Criteria::sum('weight') * 10;
        if (Criteria::count() < 1) $maxWeight = 10;
        return view('admin.criteria.create', compact('maxWeight'));

    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'weight' => 'required',
            'atribut' => 'required'
        ]);

        Criteria::create([
            'code' => $request->code,
            'name' => $request->name,
            'weight' => $request->weight / 10,
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
        $maxWeight = (Criteria::sum('weight') - $criteria->weight) * 10;
        return view('admin.criteria.edit', compact('criteria', 'maxWeight'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'weight' => 'required',
            'atribut' => 'required',
        ]);

        $criteria = [
            'code' => $request->code,
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
