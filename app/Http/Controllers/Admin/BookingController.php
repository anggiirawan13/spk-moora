<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
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
            'time' => 'required|date_format:H:i',
            'type' => 'required|in:test_drive,reservasi',
        ]);

        $datetime = Carbon::parse("{$request->date} {$request->time}");
        $now = Carbon::now();

        if ($datetime->lessThan($now)) {
            return back()->withErrors(['time' => 'Tanggal dan jam booking tidak boleh di masa lalu.'])->withInput();
        }

        if ($datetime->hour < 8 || $datetime->hour > 17) {
            return back()->withErrors(['time' => 'Booking hanya diperbolehkan antara jam 08:00 sampai 17:00.'])->withInput();
        }

        if ($datetime->isSunday()) {
            return back()->withErrors(['date' => 'Booking tidak tersedia pada hari Minggu.'])->withInput();
        }

        $exists = Booking::where('car_id', $request->alternative_id)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->where('status', '!=', 'rejected')
            ->exists();

        if ($exists) {
            return back()->withErrors(['time' => 'Mobil ini sudah dibooking pada tanggal dan jam tersebut.'])->withInput();
        }

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
