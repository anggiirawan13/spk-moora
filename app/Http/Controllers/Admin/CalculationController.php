<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternative;

class CalculationController extends Controller
{
    public function hitung(Request $request)
    {
        // Ambil data kriteria dan alternatif
        $kriteria = Criteria::all();
        $alternatif = Alternative::with('values')->get();

        // Ambil total bobot (hindari pembagian nol)
        $totalBobot = $kriteria->sum('bobot') ?: 1;

        // Normalisasi bobot
        $bobot = [];
        foreach ($kriteria as $k) {
            $bobot[$k->id] = $k->bobot / $totalBobot;
        }

        // Normalisasi matriks keputusan
        $normalisasi = [];
        $sumSquared = [];

        foreach ($kriteria as $k) {
            // Hitung jumlah kuadrat nilai kriteria
            $sumSquared[$k->id] = $alternatif->sum(function ($a) use ($k) {
                $nilai = optional($a->values->where('criteria_id', $k->id)->first())->nilai ?? 0;
                return pow($nilai, 2);
            });

            // Ambil akar dari jumlah kuadrat
            $sqrtSumSquared = sqrt($sumSquared[$k->id]) ?: 1;

            // Normalisasi setiap alternatif
            foreach ($alternatif as $a) {
                $nilai = optional($a->values->where('criteria_id', $k->id)->first())->nilai ?? 0;
                $normalisasi[$a->id][$k->id] = $nilai / $sqrtSumSquared;
            }
        }

        // Hitung nilai optimasi MOORA
        $nilaiMoora = [];
        foreach ($alternatif as $a) {
            $benefit = 0;
            $cost = 0;

            foreach ($kriteria as $k) {
                $normalizedValue = $normalisasi[$a->id][$k->id] ?? 0;

                if (strtolower($k->atribut) == 'benefit') {
                    $benefit += $bobot[$k->id] * $normalizedValue;
                } else {
                    $cost += $bobot[$k->id] * $normalizedValue;
                }
            }

            $nilaiMoora[$a->id] = $benefit - $cost;
        }

        // Urutkan alternatif berdasarkan nilai MOORA tertinggi
        arsort($nilaiMoora);

        return view('admin.moora.hitung', compact('alternatif', 'kriteria', 'normalisasi', 'bobot', 'nilaiMoora'));
    }
}
