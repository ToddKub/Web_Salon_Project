<?php

namespace App\Http\Controllers;

use App\Models\Booking;


use Illuminate\Http\Request;

class showCalendarController extends Controller
{
    public function showCalendar()
    {
        return view('tablequeue');
    }

    public function getEvents()
    {
        $bookings = Booking::whereIn('payment_status',['ชำระเงินแล้ว','จ่ายที่หลัง'])->get();
        $events = [];
        foreach ($bookings as $booking) {
            $events[] = [
                'title' => 'Booking #' . $booking->booking_id,
                'start' => $booking->date,
                'allDay' => true,
            ];
        }
        return response()->json($events);
    }
}
