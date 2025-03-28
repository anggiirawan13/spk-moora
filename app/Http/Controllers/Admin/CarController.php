<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Models\TransmissionType;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\CarStoreRequest;
use App\Http\Requests\Admin\CarUpdateRequest;
use App\Models\CarBrand;
use App\Models\CarType;
use App\Models\FuelType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CarController extends Controller
{
    public function index(): View
    {
        $cars = Car::latest()->get();
        return view('admin.car.index', compact('cars'));
    }

    public function create(): View
    {
        $brands = CarBrand::all();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $transmissionTypes = TransmissionType::all();

        return view('admin.car.create', compact( 'brands', 'carTypes', 'fuelTypes', 'transmissionTypes'));
    }

    public function store(CarStoreRequest $request): RedirectResponse
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

    public function edit(Car $car): View
    {
        $brands = CarBrand::all();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $transmissionTypes = TransmissionType::all();

        return view('admin.car.edit', compact('car', 'brands', 'carTypes', 'fuelTypes', 'transmissionTypes'));
    }

    public function update(CarUpdateRequest $request, Car $car): RedirectResponse
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
        if($car->image_path){
            unlink('storage/' . $car->image_path);
        }
        $car->delete();
        return redirect()->back()->with([
            'message'=> 'Data Berhasil DiHapus',
            'alert-type' => 'danger'
        ]);
    }
}
