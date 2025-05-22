<?php

namespace App\Http\Controllers\Admin;

use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\AlternativeValue;
use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlternativeController extends Controller
{
    public function index(): View
    {
        $criterias = Criteria::orderBy('created_at', 'asc')->get();

        $alternatives = Alternative::with(['values.subCriteria', 'car'])->get()->map(function ($alt) use ($criterias) {
            $data = [
                'id' => $alt->id,
                'name' => $alt->car?->name
            ];

            foreach ($criterias as $criteria) {
                $value = $alt->values->firstWhere('criteria_id', $criteria->id);
                $data[$criteria->id] = $value && $value->subCriteria
                    ? $value->subCriteria->name
                    : '-';
            }

            return $data;
        });

        return view('admin.alternative.index', compact('criterias', 'alternatives'));
    }

    public function create(): View
    {
        $cars = Car::all();
        $criteria = Criteria::with('subCriteria')->orderBy('id', 'asc')->get();
        return view('admin.alternative.create', compact('criteria', 'cars'));
    }

    public function show($id)
    {
        $alternative = Alternative::with([
            'values.criteria',
            'values.subCriteria',
            'car'
        ])->findOrFail($id);

        return view('admin.alternative.show', compact('alternative'));
    }

    public function edit($id): View
    {
        $cars = Car::all();
        $alternative = Alternative::findOrFail($id);

        $criteria = Criteria::with('subCriteria')->orderBy('id', 'asc')->get();

        $selectedSubs = AlternativeValue::where('alternative_id', $id)
            ->pluck('sub_criteria_id', 'criteria_id');

        return view('admin.alternative.edit', compact('alternative', 'criteria', 'selectedSubs', 'cars'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'car_id' => 'required|numeric|exists:cars,id',
            'criteria' => 'required|array',
            'criteria.*' => 'required|numeric|exists:sub_criterias,id',
        ]);

        $alternative = Alternative::create([
            'car_id' => $request->car_id,
        ]);

        foreach ($request->criteria as $criteriaId => $subCriteriaId) {
            AlternativeValue::create([
                'alternative_id'   => $alternative->id,
                'criteria_id'      => $criteriaId,
                'sub_criteria_id'  => $subCriteriaId,
            ]);
        }

        return redirect()->route('alternative.index')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $alternative = Alternative::findOrFail($id);

        $request->validate([
            'car_id' => 'required|numeric|exists:cars,id',
            'criteria' => 'required|array',
            'criteria.*' => 'required|numeric|exists:sub_criterias,id',
        ]);

        $alternative->update(['car_id' => $request->car_id]);

        foreach ($request->criteria as $criteriaId => $subCriteriaId) {
            AlternativeValue::updateOrCreate(
                [
                    'alternative_id' => $alternative->id,
                    'criteria_id' => $criteriaId,
                ],
                [
                    'sub_criteria_id' => $subCriteriaId,
                ]
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
