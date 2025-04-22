<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternative;
use Barryvdh\DomPDF\PDF as PDF;

class CalculationController extends Controller
{
    public function calculation(Request $request)
    {
        $criteria = Criteria::with('subCriteria')->get();
        $alternatives = Alternative::with(['values.subCriteria'])->get();

        // Hitung total bobot kriteria (agar bisa dinormalisasi)
        $totalWeight = $criteria->sum('weight') ?: 1;

        // Hitung bobot kriteria global (dinormalisasi)
        $weight = [];
        foreach ($criteria as $k) {
            $weight[$k->id] = $k->weight / $totalWeight;
        }

        // Hitung bobot global setiap sub-kriteria berdasarkan nilai mentah
        $subCriteriaGlobalWeights = [];
        foreach ($criteria as $k) {
            $totalSubValue = $k->subCriteria->sum('value') ?: 1;

            foreach ($k->subCriteria as $sub) {
                $subCriteriaGlobalWeights[$sub->id] = ($sub->value / $totalSubValue) * $weight[$k->id];
            }
        }

        // Normalisasi bobot global per kriteria
        $normalization = [];
        $sumSquared = [];

        foreach ($criteria as $k) {
            // Jumlah kuadrat semua bobot sub-kriteria yang digunakan oleh alternatif
            $sumSquared[$k->id] = max($alternatives->sum(function ($a) use ($k, $subCriteriaGlobalWeights) {
                $sub = optional($a->values->firstWhere('criteria_id', $k->id))->subCriteria;
                $globalWeight = $subCriteriaGlobalWeights[$sub->id] ?? 0;
                return pow($globalWeight, 2);
            }), 1);

            $sqrtSumSquared = sqrt($sumSquared[$k->id]);

            foreach ($alternatives as $a) {
                $sub = optional($a->values->firstWhere('criteria_id', $k->id))->subCriteria;
                $globalWeight = $subCriteriaGlobalWeights[$sub->id] ?? 0;

                $normalization[$a->id][$k->id] = $globalWeight / $sqrtSumSquared;
            }
        }

        // Hitung nilai MOORA
        $valueMoora = [];
        foreach ($alternatives as $a) {
            $benefit = 0;
            $cost = 0;

            foreach ($criteria as $k) {
                $normalizedValue = $normalization[$a->id][$k->id] ?? 0;

                if (strtolower(trim($k->attribute_type)) === 'benefit') {
                    $benefit += $normalizedValue;
                } else {
                    $cost += $normalizedValue;
                }
            }

            $valueMoora[$a->id] = $benefit - $cost;
        }

        // Urutkan dari skor tertinggi
        arsort($valueMoora);

        return view('admin.moora.calculation', compact(
            'alternatives',
            'criteria',
            'normalization',
            'weight',
            'subCriteriaGlobalWeights',
            'valueMoora'
        ));
    }

    public function downloadPDF()
    {
        $criteria = Criteria::with('subCriteria')->get();
        $alternatives = Alternative::with(['values.subCriteria'])->get();

        // Hitung total bobot kriteria
        $totalWeight = $criteria->sum('weight') ?: 1;

        // Hitung bobot global kriteria
        $weight = [];
        foreach ($criteria as $k) {
            $weight[$k->id] = $k->weight / $totalWeight;
        }

        // Hitung bobot global sub-kriteria berdasarkan nilai mentah
        $subCriteriaGlobalWeights = [];
        foreach ($criteria as $k) {
            $totalSubValue = $k->subCriteria->sum('value') ?: 1;

            foreach ($k->subCriteria as $sub) {
                $subCriteriaGlobalWeights[$sub->id] = ($sub->value / $totalSubValue) * $weight[$k->id];
            }
        }

        // Hitung normalisasi
        $normalization = [];
        $sumSquared = [];

        foreach ($criteria as $k) {
            $sumSquared[$k->id] = max($alternatives->sum(function ($a) use ($k, $subCriteriaGlobalWeights) {
                $sub = optional($a->values->firstWhere('criteria_id', $k->id))->subCriteria;
                $globalWeight = $subCriteriaGlobalWeights[$sub->id] ?? 0;
                return pow($globalWeight, 2);
            }), 1);

            $sqrtSumSquared = sqrt($sumSquared[$k->id]);

            foreach ($alternatives as $a) {
                $sub = optional($a->values->firstWhere('criteria_id', $k->id))->subCriteria;
                $globalWeight = $subCriteriaGlobalWeights[$sub->id] ?? 0;
                $normalization[$a->id][$k->id] = $globalWeight / $sqrtSumSquared;
            }
        }

        // Hitung nilai MOORA
        $valueMoora = [];
        foreach ($alternatives as $a) {
            $benefit = 0;
            $cost = 0;

            foreach ($criteria as $k) {
                $normalizedValue = $normalization[$a->id][$k->id] ?? 0;

                if (strtolower(trim($k->attribute_type)) === 'benefit') {
                    $benefit += $normalizedValue;
                } else {
                    $cost += $normalizedValue;
                }
            }

            $valueMoora[$a->id] = $benefit - $cost;
        }

        arsort($valueMoora);

        // Generate PDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.moora.pdf_report', compact(
            'alternatives',
            'criteria',
            'normalization',
            'weight',
            'subCriteriaGlobalWeights',
            'valueMoora'
        ));

        return $pdf->download('laporan_moora.pdf');
    }
}
