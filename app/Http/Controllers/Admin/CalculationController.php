<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternative;

class CalculationController extends Controller
{
    public function calculation(Request $request)
    {
        $criteria = Criteria::all();
        $alternative = Alternative::with('values')->get();

        $totalBobot = $criteria->sum('weight') ?: 1;

        $weight = [];
        foreach ($criteria as $k) {
            $weight[$k->id] = $k->weight / $totalBobot;
        }

        $normalization = [];
        $sumSquared = [];

        foreach ($criteria as $k) {
            $sumSquared[$k->id] = $alternative->sum(function ($a) use ($k) {
                $value = optional($a->values->where('criteria_id', $k->id)->first())->value ?? 0;
                return pow($value, 2);
            });

            $sqrtSumSquared = sqrt($sumSquared[$k->id]) ?: 1;

            foreach ($alternative as $a) {
                $value = optional($a->values->where('criteria_id', $k->id)->first())->value ?? 0;
                $normalization[$a->id][$k->id] = $value / $sqrtSumSquared;
            }
        }

        $valueMoora = [];
        foreach ($alternative as $a) {
            $benefit = 0;
            $cost = 0;

            foreach ($criteria as $k) {
                $normalizedValue = $normalization[$a->id][$k->id] ?? 0;

                if (strtolower($k->atribut) == 'benefit') {
                    $benefit += $weight[$k->id] * $normalizedValue;
                } else {
                    $cost += $weight[$k->id] * $normalizedValue;
                }
            }

            $valueMoora[$a->id] = $benefit - $cost;
        }

        arsort($valueMoora);

        return view('admin.moora.calculation', compact('alternative', 'criteria', 'normalization', 'weight', 'valueMoora'));
    }
}
