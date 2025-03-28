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
    public function index(): View
    {
        $criteria = Criteria::orderBy('id', 'asc')->get();
        $alternative = Alternative::with('values')->orderBy('created_at', 'asc')->get();
        
        return view('admin.alternative.index', compact('criteria', 'alternative'));
    }

    public function create(): View
    {
        $criteria = Criteria::orderBy('id', 'asc')->get();
        return view('admin.alternative.create', compact('criteria'));
    }

    public function store(Request $request): RedirectResponse
    {
        $criteria = Criteria::all();

        $rules = ['name' => 'required'];
        foreach ($criteria as $k) {
            $rules["value_{$k->id}"] = 'required|numeric';
        }

        $request->validate($rules);

        $alternative = Alternative::create([
            'name' => $request->name,
        ]);

        foreach ($criteria as $k) {
            AlternativeValue::create([
                'alternative_id' => $alternative->id,
                'criteria_id' => $k->id,
                'value' => $request->input("value_{$k->id}"),
            ]);
        }

        return redirect()->route('alternative.index')->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        $alternative = Alternative::with('values.criteria')->findOrFail($id);
        return view('admin.alternative.show', compact('alternative'));
    }

    public function edit($id): View
    {
        $alternative = Alternative::findOrFail($id);
        $criteria = Criteria::orderBy('id', 'asc')->get();
        $valueAlternatif = AlternativeValue::where('alternative_id', $id)->pluck('value', 'criteria_id');

        return view('admin.alternative.edit', compact('alternative', 'criteria', 'valueAlternatif'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $alternative = Alternative::findOrFail($id);
        $criteria = Criteria::all();

        $rules = ['name' => 'required'];
        foreach ($criteria as $k) {
            $rules["value_{$k->id}"] = 'required|numeric';
        }
        $request->validate($rules);

        $alternative->update(['name' => $request->name]);

        foreach ($criteria as $k) {
            AlternativeValue::updateOrCreate(
                [
                    'alternative_id' => $alternative->id,
                    'criteria_id' => $k->id,
                ],
                ['value' => $request->input("value_{$k->id}")]
            );
        }

        return redirect()->route('alternative.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id): RedirectResponse
    {
        $alternative = Alternative::findOrFail($id);

        AlternativeValue::where('alternative_id', $id)->delete();

        $alternative->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
