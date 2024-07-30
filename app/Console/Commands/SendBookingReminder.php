<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\log;


class SendBookingReminder extends Command
{
    protected $signature = 'send:booking-reminder';

    protected $description = 'Send booking reminders to customers via Line Notify';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {   
        log::info('SendBookingReminder command started');

        $tomorrow = Carbon::now()->addDay()->toDateString();
        log::info('Checking bookings for date: ' . $tomorrow);

        $bookings = Booking::whereDate('date', $tomorrow)->where(function ($query) {
            $query->where('payment_status', 'ชำระเงินแล้ว')
                ->orWhere('payment_status', 'จ่ายที่หลัง');
        })
        ->get();

        log::info('Bookings for tomorrow: ' . $bookings->count());

        foreach ($bookings as $booking) {
            log::info('Processing booking ID: ' . $booking->id);
            $user = User::find($booking->user_id);

            if ($user) {
                log::info('User found: ' . $user->id . ', Line Access Token: ' . ($user->line_token ? 'Yes' : 'No'));
            } else {
                log::warning('User not found for booking ID: ' . $booking->id);
            }

            if ($user && $user->line_token) {
                $bookingDate = Carbon::parse($booking->date)->format('d-m-Y');
                $message = "\nแจ้งเตื่อน:คุณได้จองบริการของร้าน Ravi \nบริการ: {$booking->service} \nวันที่: ".Carbon::parse($booking->date)->format('d-m-Y') . " \nช่วงเวลา {$booking->time}.\nช่างที่ให้บริการ: {$booking->beautician_name}.";
                Log::info('Generated message: ' . $message);
            
                if (!empty($message)) {
                    Log::info('Sending notification to user ID: ' . $user->id);
                    $this->sendLineNotify($user->line_token, $message);
                } else {
                    Log::warning('Generated message is empty for booking ID: ' . $booking->id);
                }
            } else {
                Log::warning('User or line token not found for booking ID: ' . $booking->id);
            }
        }

        log::info('SendBookingReminder command finished');
    }
    private function sendLineNotify($token, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}",
        ])->attach('message', $message)->post('https://notify-api.line.me/api/notify');

        if ($response->successful()) {
            Log::info("Notification sent successfully.");
        } else {
            Log::error("Failed to send notification: " . $response->body());
        }
    }
}
