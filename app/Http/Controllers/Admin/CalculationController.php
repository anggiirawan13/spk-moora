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
        $criteria = Criteria::with(['subCriteria'])->get();
        $alternatives = Alternative::with(['values.subCriteria'])->get();

        // Normalisasi bobot kriteria
        $totalWeight = $criteria->sum('weight') ?: 1;
        $weight = $criteria->pluck('weight', 'id')->map(fn($w) => $w / $totalWeight);

        // Ambil semua nilai alternatif berdasarkan sub_criterias.value
        $altValues = [];

        foreach ($alternatives as $alt) {
            foreach ($criteria as $c) {
                $sub = optional($alt->values->firstWhere('criteria_id', $c->id))->subCriteria;
                $altValues[$alt->id][$c->id] = $sub->value ?? 0;
            }
        }

        // Normalisasi nilai alternatif per kriteria (sqrt(sum^2))
        $normDivisor = [];
        foreach ($criteria as $c) {
            $sumSquares = 0;
            foreach ($alternatives as $alt) {
                $val = $altValues[$alt->id][$c->id] ?? 0;
                $sumSquares += pow($val, 2);
            }
            $normDivisor[$c->id] = sqrt($sumSquares) ?: 1;
        }

        // Normalisasi dan perhitungan MOORA
        $normalization = [];
        $valueMoora = [];

        foreach ($alternatives as $alt) {
            $benefit = 0;
            $cost = 0;

            foreach ($criteria as $c) {
                $raw = $altValues[$alt->id][$c->id] ?? 0;
                $norm = $raw / $normDivisor[$c->id];
                $weighted = $norm * $weight[$c->id];

                $normalization[$alt->id][$c->id] = $weighted;

                if (strtolower($c->attribute_type) === 'benefit') {
                    $benefit += $weighted;
                } else {
                    $cost += $weighted;
                }
            }

            $valueMoora[$alt->id] = $benefit - $cost;
        }

        arsort($valueMoora);

        return view('admin.moora.calculation', compact(
            'alternatives',
            'criteria',
            'normalization',
            'weight',
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
