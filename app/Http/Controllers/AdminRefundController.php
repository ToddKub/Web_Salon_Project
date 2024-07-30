<?php

namespace App\Http\Controllers;

use App\Models\Refunduser;
use App\Models\Booking;
use Stripe\Stripe;
use Illuminate\Http\Request;

class AdminRefundController extends Controller

{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function showRefundRequests()
    {
        $refunds = Refunduser::with('user')->paginate(5);
        return view('admin.refund', compact('refunds'));
    }
    public function update(Request $request, Refunduser $refund)
    {
        if ($refund->status !== 'approved' && $refund->status !== 'rejected') {
            if ($request->input('action') === 'approve') {

                $booking = Booking::where('booking_id', $refund->booking_id)->first();
                if ($booking) {
                    $payment = \Stripe\PaymentIntent::retrieve($booking->payment_intent_id);
                    $refundAmount = $payment->amount;
                    // หากพบ booking ที่เกี่ยวข้อง ให้ดึงข้อมูลการจ่ายเงิน (charge) หรือการทำธุรกรรมที่ต้องการทำการ refund
                    $chargeId = $booking->payment_intent_id;
                    // สร้างคำขอการ refund ด้วย Stripe API
                    $stripeRefund = \Stripe\Refund::create([
                        'payment_intent' => $chargeId,
                        'amount' => $refundAmount,
                        // สามารถเพิ่มพารามิเตอร์เพิ่มเติมตามความต้องการได้
                    ]);
                    // อัปเดตสถานะของการขอคืนเงินเป็น 'approved'
                    $refund->status = 'approved';
                    $refund->save();
                    $booking->payment_status = 'ขอคืนเงินแล้ว';
                    $booking->save();
                    //dd($refund);                                    
                }
            } elseif ($request->input('action') === 'reject') {
                // อัปเดตสถานะขอคืนเงินเป็น 'rejected'
                $refund->status = 'rejected';
                $refund->save();
            }
        }
        return redirect()->route('admin.refund');
    }
}
