<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;


class LinefolController extends Controller
{
    public function sendAllBookings(Request $request)
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->get();

        $message = "รายการจองของคุณ:\n";

        foreach ($bookings as $booking) {
            $message .= "หมายเลขการจอง: {$booking->booking_id}\n";
            $message .= "บริการ: {$booking->service}\n";
            $message .= "วันที่: {$booking->date}\n";
            $message .= "เวลา: {$booking->time}\n";
            $message .= "ช่าง: {$booking->beautician_name}\n";
            $message .= "สถานะการชำระเงิน: {$booking->payment_status}\n\n";
        }

        $response = $this->sendLineNotify($message);

        if ($response->successful()) {
            return back()->with('success', 'ส่งข้อมูลการจองทั้งหมดสำเร็จ');
        }

        return back()->with('error', 'ไม่สามารถส่งข้อมูลการจองได้');
    }

    private function sendLineNotify($message)
    {
        $token = env('LINE_NOTIFY_TOKEN');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->asForm()->post('https://notify-api.line.me/api/notify', [
            'message' => $message,
        ]);

        return $response;
    }
}
