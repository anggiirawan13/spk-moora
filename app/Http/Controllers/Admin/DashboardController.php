<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Car;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $car = Car::count();
        $criteria = Criteria::count();
        $alternative = Alternative::count();

        $data = (object) [
            'car' => $car,
            'criteria' => $criteria,
            'alternative' => $alternative,
        ];

        return view('admin.dashboard', compact('data'));
    }
}
