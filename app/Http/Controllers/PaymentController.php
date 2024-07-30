<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;


class PaymentController extends Controller
{
    public function checkoutqueue(Request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['promptpay', 'card'],
            'customer_email' => Auth::user()->email,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'thb',
                        'unit_amount' => $request->price * 100,
                        'product_data' => [
                            'name' => $request->service_queue,
                            'description' => "**รายละเอียดการจอง:**\n ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ
                            วันที่: $request->date_queue\nㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ
                            บริการ: $request->service_queue\nㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ
                            ช่าง: $request->beautician_name_queue\nㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ
                            เวลา: $request->time_queue\n",
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'metadata' => [
                'booking_number' => $request->booking_id,
                'service' => $request->service_queue,
                'date' => $request->date_queue,
                'time' => $request->time_queue,
                'beautician_name' => $request->beautician_name_queue,
                'price' => $request->price,
            ],
            'submit_type' => 'book',  
            'mode' => 'payment',
            'success_url' => route('payment.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
        ]);
        //for check api
        //dd($session);
        if(isset($session->id) && $session->id != ''){
            return redirect()->away($session->url);
        } else {
            return 'cant redirect to url';
          }
        }
      }