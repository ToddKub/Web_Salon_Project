<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Http;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendBookingNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-booking-notifications';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send booking notifications to users 1 day before their booking date';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $bookings = Booking::whereDate('date', Carbon::tomorrow()->toDateString())->get();

        foreach ($bookings as $booking) {
            $message = "คุณมีการจองคิวในวันพรุ่งนี้:\n";
            $message .= "หมายเลขการจอง: {$booking->booking_id}\n";
            $message .= "บริการ: {$booking->service}\n";
            $message .= "วันที่: {$booking->date}\n";
            $message .= "เวลา: {$booking->time}\n";
            $message .= "ช่าง: {$booking->beautician_name}\n";
            $message .= "สถานะการชำระเงิน: {$booking->payment_status}\n";

            $this->sendLineNotify($message, $booking->user->line_token);
        }

        return 0;
    }

    private function sendLineNotify($message, $token)
    {
        Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->asForm()->post('https://notify-api.line.me/api/notify', [
            'message' => $message,
        ]);
    }
}
