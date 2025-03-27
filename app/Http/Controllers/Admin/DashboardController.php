<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Car;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $mobil = Car::count();
        $kriteria = Criteria::count();
        $alternatif = Alternative::count();

        $data = (object) [
            'mobil' => $mobil,
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
        ];

        return view('admin.dashboard', compact('data'));
    }
}
