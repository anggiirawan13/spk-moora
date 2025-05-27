<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        if (Auth::user()->is_admin === 1) {
            $bookings = Booking::with(['user', 'car'])->latest()->get();
        } else {
            $bookings = Booking::with(['user', 'car'])
                ->where('user_id', Auth::user()->id)
                ->latest()
                ->get();
        }

        return view('admin.booking.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternative_id' => 'required|exists:cars,id',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required|in:test_drive,reservasi',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $request->alternative_id,
            'phone' => $request->phone,
            'date' => $request->date,
            'time' => $request->time,
            'type' => $request->type,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil dikirim!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return redirect()->back()->with('success', 'Status booking diperbarui.');
    }
}
