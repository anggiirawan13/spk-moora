<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Models\TransmissionType;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\CarRequest;
use App\Models\CarBrand;
use App\Models\CarType;
use App\Models\FuelType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CarController extends Controller
{
    public function index(): View
    {
        $cars = Car::latest()->get();

        $cars->transform(function ($car) {
            return [
                'id' => $car->id,
                'image' => '<a href="#" data-toggle="modal" data-target="#imageModal" onclick="showImage(\'' . $car->name . '\', \'' . asset('storage/car/' . ($car->image_path ?? 'img/default-image.png')) . '\')">
                                <img class="default-img" src="' . asset('storage/car/' . ($car->image_path ?? 'img/default-image.png')) . '" width="60">
                            </a>',
                'license_plate' => $car->license_plate,
                'name' => $car->name,
                'price' => 'Rp ' . number_format($car->price, 0, ',', '.'),
                'manufacture_year' => $car->manufacture_year,
                'mileage' => number_format($car->mileage, 0, ',', '.') . ' Kilometer',
                'fuel_type' => $car->fuelType?->name ?? 'N/A',
                'engine_capacity' => $car->engine_capacity . ' cc',
                'seat_count' => $car->seat_count,
                'transmission_type' => $car->transmissionType?->name ?? 'N/A',
                'color' => $car->color,
                'is_available' => $car->is_available ? 'Tersedia' : 'Tidak Tersedia',
            ];
        });

        return view('admin.car.index', compact('cars'));
    }

    public function create(): View
    {
        $brands = CarBrand::all();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $transmissionTypes = TransmissionType::all();

        return view('admin.car.create', compact('brands', 'carTypes', 'fuelTypes', 'transmissionTypes'));
    }

    public function store(CarRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $gambar = $request->file('image_path')->store('car', 'public');
            $gambarName = basename($gambar);

            $slug = Str::slug($request->name, '-');

            Car::create($request->except('image_path') + ['image_path' => $gambarName, 'slug' => $slug]);
        }

        return redirect()->route('car.index')->with([
            'message' => 'Data Berhasil Ditambahkan',
            'alert-type' => 'success'
        ]);
    }

    public function show($id)
    {
        $car = Car::with(['carBrand', 'carType', 'fuelType', 'transmissionType'])->findOrFail($id);
        return view('admin.car.show', compact('car'));
    }

    public function showComparisonForm()
    {
        $cars = Car::all();

        return view('admin.car.compare_form', compact('cars'));
    }

    public function compare(Request $request)
    {
        $request->validate([
            'car1' => 'required|exists:cars,id',
            'car2' => 'required|exists:cars,id',
        ]);

        $car1 = Car::with(['carBrand', 'carType', 'fuelType', 'transmissionType'])->findOrFail($request->car1);
        $car2 = Car::with(['carBrand', 'carType', 'fuelType', 'transmissionType'])->findOrFail($request->car2);

        return view('admin.car.compare', compact('car1', 'car2'));
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $brands = CarBrand::all();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $transmissionTypes = TransmissionType::all();

        return view('admin.car.edit', compact('car', 'brands', 'carTypes', 'fuelTypes', 'transmissionTypes'));
    }

    public function update(CarRequest $request, Car $car): RedirectResponse
    {
        if ($request->validated()) {
            $slug = Str::slug($request->name, '-');
            $dataUpdate = $request->except('image_path') + ['slug' => $slug];

            if ($request->hasFile('image_path')) {
                if ($car->image_path) {
                    Storage::delete('public/car/' . $car->image_path);
                }

                $gambar = $request->file('image_path')->store('car', 'public');
                $gambarName = basename($gambar);

                $dataUpdate['image_path'] = $gambarName;
            }

            $car->update($dataUpdate);
        }

        return redirect()->route('car.index')->with([
            'message' => 'Data Berhasil Diubah',
            'alert-type' => 'info'
        ]);
    }

    public function destroy(Car $car): RedirectResponse
    {
        if ($car->image_path) {
            unlink('storage/' . $car->image_path);
        }
        $car->delete();
        return redirect()->back()->with([
            'message' => 'Data Berhasil DiHapus',
            'alert-type' => 'danger'
        ]);
    }
}
