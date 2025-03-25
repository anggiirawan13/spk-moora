<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Message;
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
        $pesan = Message::count();
        $kriteria = Criteria::count();
        $alternatif = Alternative::count();

        $data = (object) [
            'mobil' => $mobil,
            'pesan' => $pesan,
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
        ];

        return view('admin.dashboard', compact('data'));
    }
}
