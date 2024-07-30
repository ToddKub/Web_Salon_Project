<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\AvailableTime;
use App\Models\Beautician;
use App\Models\Service;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ReservationController extends Controller
{

    public function index()
    {
        $availableTimes = AvailableTime::orderByRaw("CAST(SUBSTRING_INDEX(time_slot, '->', 1) AS TIME)")->pluck('time_slot')->toArray();
        $availableBeauticians = Beautician::all()->pluck('name')->toArray();
        $selectService = Service::all()->pluck('name')->toArray();
        $bookings = Booking::sortable(['booking_id' => 'desc'])->paginate(5);
        return view('bookings.index', compact('bookings','availableTimes','availableBeauticians','selectService'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'user_id' => 'required',
            'service' => 'required',
            'time' => 'required',
            'date' => 'required',
            'beautician_name' => 'required',
            'payment_status' => 'required',
        ]);

        $booking = new Booking();
        $booking->booking_id = $request->input('booking_id');
        $booking->user_id = $request->input('user_id');
        $booking->service = $request->input('service');
        $booking->time = $request->input('time');
        $booking->date = $request->input('date');
        $booking->beautician_name = $request->input('beautician_name');
        $booking->payment_status = $request->input('payment_status');

        $booking->save();
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
    }

    public function edit($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $booking_id)
    {
       
        $booking = Booking::findOrFail($booking_id);
        $service = Service::where('name', $request->input('service'))->first();

        if ($service) {
            $booking->update([
                'service' => $request->input('service') ?? $booking->service,
                'time' => $request->input('time') ?? $booking->time,
                'date' => $request->input('date') ?? $booking->date,
                'beautician_name' => $request->input('beautician_name') ?? $booking->beautician_name,
                'price' => $service->price, // อัพเดตราคาจากตาราง Service
            ]);
        } else {
            $booking->update([
                'service' => $request->input('service') ?? $booking->service,
                'time' => $request->input('time') ?? $booking->time,
                'date' => $request->input('date') ?? $booking->date,
                'beautician_name' => $request->input('beautician_name') ?? $booking->beautician_name,
            ]);
        }
    
        return redirect()->route('bookings.index')->with('toast_success', 'อัพเดตข่อมูลคิวเรียบร้อย');
    }

    public function destroy($booking_id)
    {
        $booking = Booking::where('booking_id', $booking_id)->first();

        if ($booking) {
            $booking->delete();
            return redirect()->route('bookings.index')->with('toast_success', 'ลบคิวเรียบร้อย');
        } else {
            return redirect()->route('bookings.index')->with('error', 'Booking not found');
        }
    }
    public function updatepaylater(Booking $book_id)
    {

        $book_id->payment_status = 'ชำระเงินที่ร้านเแล้ว';
        $book_id->save();

        return redirect()->route('bookings.index')->with('toast_success', 'อัปเดตสถานะการจ่ายเงินสำเร็จ');
    }
}
