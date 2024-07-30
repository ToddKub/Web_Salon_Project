<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Beautician;
use App\Models\Service;
use App\Models\AvailableTime;
use Illuminate\Support\Carbon;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;


class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [

                'service' => 'required',
                'time' => 'required',
                'date' => 'required|date_format:Y-m-d|after_or_equal:today',
                'beautician_name' => 'required',
                'payment_mode' => 'required',
            ],
            [
                'service.required' => 'กรุณาเลือกบริการ',
                'time.required' => 'กรุณาเลือกช่วงเวลา',
                'beautician_name.required' => 'กรุณาเลือกช่าง',

            ]
        );
        /* $servicePrice = [
            'ต่อขนตา' => ['half' => 1000, 'full' => 1000],
            'สักคิ้ว' => ['half' => 1600, 'full' => 1600],
            'ฝังสีอายไลเนอร์' => ['half' => 1200, 'full' => 1200],
            'ฝังสีปาก' => ['half' => 1000, 'full' => 1000],
        ];*/

        $selectedService = $request->service;
        $paymentMode = $request->payment_mode;

        $availableTimes = AvailableTime::pluck('time_slot')->toArray();

        // ตรวจสอบเวลาที่เลือกจอง
        $selectedDate = $request->date;
        $selectedTime = str_replace('.', ':', $request->time); // แปลง '.' เป็น ':'

        // แยกช่วงเวลาออกจากกัน
        list($startTime, $endTime) = explode('->', $selectedTime);
        $startTime = str_replace('.', ':', trim($startTime));
        $endTime = str_replace('.', ':', trim($endTime));

        // สร้างเวลาจากข้อมูลที่ได้รับ
        try {
            $selectedStartDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', "{$selectedDate} {$startTime}");
            $selectedEndDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', "{$selectedDate} {$endTime}");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'เวลาที่กำหนดไม่ถูกต้อง: ' . $e->getMessage());
        }

        $now = \Carbon\Carbon::now('Asia/Bangkok');
        $nowString = $now->toDateTimeString();
        $selectedStartString = $selectedStartDateTime->toDateTimeString();


        if ($selectedStartString <= $nowString) {
            return redirect()->back()->with('error', 'ไม่สามารถจองเวลาที่ผ่านมาแล้วได้');
        }

        // ตรวจสอบว่าช่วงเวลาที่เลือกอยู่ในช่วงเวลาที่มีอยู่ใน AvailableTime หรือไม่
        $isValidTime = false;
        foreach ($availableTimes as $timeSlot) {
            $timeParts = explode('->', $timeSlot);
            if (count($timeParts) == 2) {
                $availableStartTime = str_replace('.', ':', trim($timeParts[0]));
                $availableEndTime = str_replace('.', ':', trim($timeParts[1]));

                try {
                    $availableStartDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', "{$selectedDate} {$availableStartTime}");
                    $availableEndDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', "{$selectedDate} {$availableEndTime}");

                    if ($selectedStartDateTime->between($availableStartDateTime, $availableEndDateTime)) {
                        $isValidTime = true;
                        break;
                    }
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'ช่วงเวลาที่กำหนดไม่ถูกต้อง: ' . $e->getMessage());
                }
            }
        }

        if (!$isValidTime) {
            return redirect()->back()->with('error', 'เวลาที่เลือกไม่อยู่ในช่วงเวลาที่กำหนด');
        }


        $servicePrice = Service::where('name', $selectedService)->firstOrFail();

        $existingBooking = Booking::where('date', $request->date)
            ->where('time', $request->time)
            ->where('beautician_name', $request->beautician_name)
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'ขออภัยค่ะ ไม่สามารถทำการจองให้คุณได้ กรุณาเลือกวันเเละเวลาอื่นอีกครั้งค่ะ 🙏');
        }

        if ($paymentMode == 'paylater') {
            // บันทึกการจองและสถานะการชำระเงิน
            $price = $servicePrice->price;
            $booking = [
                'service' => $request->service,
                'time' => $request->time,
                'date' => $request->date,
                'beautician_name' => $request->beautician_name,
                'user_id' => Auth::user()->id,
                'price' => $price,
                'payment_status' => 'จ่ายที่หลัง',
            ];
            Alert::success('จองบริการสำเร็จ', 'กรุณาเตรียมเงินให้สำหรับจ่ายที่ร้าน');
            $newBooking = Booking::create($booking);

            // ไปหน้าแสดงคิว
            return redirect('queueinfo');
        } else {
            $price = $servicePrice->price;
            $booking = [
                'service' => $request->service,
                'time' => $request->time,
                'date' => $request->date,
                'beautician_name' => $request->beautician_name,
                'user_id' => Auth::user()->id,
                'price' => $price,
                'payment_status' => 'รอชำระเงิน', // เพิ่มสถานะการชำระเงินใหม่
            ];

            //$newBooking=DB::table('bookings')->insert($booking);
            $newBooking = Booking::create($booking);
            // $newBooking = DB::table('bookings')->insertGetId($booking);
            Alert::success('จองบริการสำเร็จ', 'กรุณาชำระเงิน');
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $session = $stripe->checkout->sessions->create([
                'payment_method_types' => ['promptpay', 'card'],
                'customer_email' => Auth::user()->email,
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'thb',
                            'unit_amount' => $price * 100, // เปลี่ยนเป็นเงินเรทเท่ากับสมการหรือตามที่คุณกำหนด
                            'product_data' => [
                                'name' => $selectedService,
                                'description' => "**รายละเอียดการจอง:**\n ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ
                            วันที่: {$request->date}\nㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ
                            บริการ: $selectedService\nㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ
                            ช่าง: {$request->beautician_name}\nㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ
                            เวลา: {$request->time}\n", // เพิ่ม description

                            ],
                        ],
                        'quantity' => 1,
                    ],
                ],
                'metadata' => [
                    'booking_number' => $newBooking->booking_id,
                    'service' => $selectedService,
                    'date' => $request->date,
                    'time' => $request->time,
                    'beautician_name' => $request->beautician_name,
                    'price' => $price,
                ],
                'submit_type' => 'book',
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}', // URL หลังจากชำระเงินสำเร็จ
                'cancel_url' => route('payment.cancel'), // URL หลังจากยกเลิกการชำระเงิน
            ]);
            if (isset($session->id) && $session->id != '') {
                return redirect($session->url);
            } else {
                return 'cant redirect to url';
            }
        }
    }
    // Create a Payment Intent with Stripe
    // Stripe::setApiKey(env('STRIPE_SECRET'));


    //Payment if success
    public function success(Request $request)
    {
        //$stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        // ดำเนินการหลังจากชำระเงินสำเร็จ เช่น อัปเดตสถานะการชำระเงินในฐานข้อมูล
        //return 'payment-success';
        // รับหมายเลขการซื้อหรือการสั่งซื้อจาก Stripe
        if (isset($request->session_id)) {
            // ใช้ Stripe API เพื่อขอข้อมูลการชำระเงิน
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            // ตรวจสอบสถานะการชำระเงิน
            if ($response->payment_status === 'paid') {
                // หากการชำระเงินสำเร็จ
                $bookingId = $response->metadata->booking_number;
                $nameuser = Auth::user()->name;
                $date = $response->metadata->date;
                $service = $response->metadata->service;
                $beauticianName = $response->metadata->beautician_name;
                $time = $response->metadata->time;
                $price = $response->metadata->price;
                //dd($response);
                $paymentIntentId = $response->payment_intent;

                // อัปเดตสถานะการชำระเงินในตาราง Bookings
                Booking::where('booking_id', $bookingId)->update([
                    'payment_status' => 'ชำระเงินแล้ว',
                    'payment_intent_id' => $paymentIntentId,

                ]);
                // คืนค่าสำหรับแสดงผลหน้า payment success
                return view('payment-success', [
                    'nameuser' => $nameuser,
                    'date' => $date,
                    'service' => $service,
                    'beauticianName' => $beauticianName,
                    'time' => $time,
                    'price' => $price,
                ]);
            }
        }
    }

    public function cancel(Request $request)
    {
        // ดำเนินการเมื่อผู้ใช้ยกเลิกการชำระเงิน
        //Alert::warning('จองบริการแล้ว', 'กรุณาชำระเงิน');
        return redirect('queueinfo')->with('info', 'จองบริการแล้ว กรุณาชำระเงิน');
    }

    //////////////////////////////////////View////////////////////////////////////////
    public function view()
    {
        $request = request();
        $disabled_dates = Holiday::pluck('closed_date')->toArray();
        /*$availableTimes = [
            "10.00->11.00",
            "12.00->13.00",
            "14.00->15.00",
            "19.00->20.00"
        ];*/

        //$availableBeauticians = [
        //  "ช่างตูมตาม",
        //"ช่างกี่"
        //];
        $availableTimes = AvailableTime::orderByRaw("CAST(SUBSTRING_INDEX(time_slot, '->', 1) AS TIME)")->pluck('time_slot')->toArray();
        $availableBeauticians = Beautician::all()->pluck('name')->toArray();
        $selectService = Service::all()->pluck('name')->toArray();
        $bookings = Booking::all();

        $selectedService = $request->service;

        $bookedDates = $bookings->where('service', $selectedService)->pluck('date')->toArray();
        $bookedTimes = $bookings->where('service', $selectedService)->pluck('time')->toArray();
        $bookedBeauticians = $bookings->where('service', $selectedService)->pluck('beautician_name')->toArray();

        $selectedDateToBook = date('Y-m-d', ($request->date));

        if (session('error')) {
            Alert::error('เกิดข้อผิดพลาด', session('error'));
        }

        $selectedDate = $request->selected_date ?? $selectedDateToBook;

        $selectedDateToBook = $request->date;
        $servicesPrices = Service::pluck('price', 'name');

        return view('queue', [
            'disabled_dates' => $disabled_dates,
            'availableTimes' => $availableTimes,
            'bookedDates' => $bookedDates,
            'bookedTimes' => $bookedTimes,
            'availableBeauticians' => $availableBeauticians,
            'selectedService' => $selectedService,
            'bookedBeauticians' => $bookedBeauticians,
            'bookings' => $bookings,
            'request' => $request,
            'selectedDate' => $selectedDate,
            'selectedDateToBook' => $selectedDateToBook,
            'selectService' => $selectService,
            'servicesPrices' => $servicesPrices,
        ]);
    }
}
