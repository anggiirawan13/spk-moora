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
        $alternatives = Alternative::with(['values.subCriteria', 'car'])->get();

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
            'valueMoora',
            'normDivisor'
        ));
    }

    public function calculationUser(Request $request)
    {
        $criteria = Criteria::with(['subCriteria'])->get();
        $alternatives = Alternative::with(['values.subCriteria', 'car'])->get();

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

        return view('admin.moora.calculation_user', compact(
            'alternatives',
            'criteria',
            'normalization',
            'weight',
            'valueMoora',
            'normDivisor'
        ));
    }

    public function downloadPDF()
    {
        $criteria = Criteria::with(['subCriteria'])->get();
        $alternatives = Alternative::with(['values.subCriteria', 'car'])->get();

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

        // Generate PDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.moora.pdf_report', compact(
            'alternatives',
            'criteria',
            'normalization',
            'weight',
            'valueMoora',
            'normDivisor'
        ));

        return $pdf->download('laporan_moora.pdf');
    }
}
