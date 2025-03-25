<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternative;

class CalculationController extends Controller
{

    public function hitung(Request $request){

        $kriteria = Criteria::sum('bobot');

        $bobot1 = 3/$kriteria;
        $bobot2 = 2/$kriteria;
        $bobot3 = 2/$kriteria;
        $bobot4 = 2/$kriteria;
        $bobot5 = 1/$kriteria;
        $widget1 = [
            'kriterias' => $bobot1,
        ];
        $widget2 = [
            'kriterias' => $bobot2,
        ];
        $widget3 = [
            'kriterias' => $bobot3,
        ];
        $widget4 = [
            'kriterias' => $bobot4,
        ];
        $widget5 = [
            'kriterias' => $bobot5,
        ];


        $alternatif = Alternative::get();
        $data = Alternative::orderby('nama', 'asc')->get();

        $minC1 = Alternative::min('C1');
        $maxC1 = Alternative::max('C1');
        $minC2 = Alternative::min('C2');
        $maxC2 = Alternative::max('C2');
        $minC3 = Alternative::min('C3');
        $maxC3 = Alternative::max('C3');
        $minC4 = Alternative::min('C4');
        $maxC4 = Alternative::max('C4');
        $minC5 = Alternative::min('C5');
        $maxC5 = Alternative::max('C5');

        $C1min =[
            'alternatifs' => $minC1,
        ];
        $C1max =[
            'alternatifs' => $maxC1,
        ];
        $C2min =[
            'alternatifs' => $minC2,
        ];
        $C2max =[
            'alternatifs' => $maxC2,
        ];
        $C3min =[
            'alternatifs' => $minC3,
        ];
        $C3max =[
            'alternatifs' => $maxC3,
        ];
        $C4min =[
            'alternatifs' => $minC4,
        ];
        $C4max =[
            'alternatifs' => $maxC4,
        ];
        $C5min =[
            'alternatifs' => $minC5,
        ];
        $C5max =[
            'alternatifs' => $maxC5,
        ];

        $hasil = $minC1/$maxC1;
        $hasil1 =[
            'alternatifs' => $hasil,
        ];

        return view('admin.saw.hitung', compact('hasil1','data', 'widget1', 'widget2', 'widget3', 'widget4', 'widget5', 'C1min', 'C1max', 'C2min', 'C2max', 'C3min', 'C3max', 'C4min', 'C4max', 'C5min', 'C5max'));
    }
}
