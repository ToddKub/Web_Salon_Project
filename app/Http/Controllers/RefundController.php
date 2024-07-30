<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Date;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Refunduser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
;

class RefundController extends Controller
{   
    public function showRefundForm($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $bookingData = [
            'id' => $booking->booking_id,
            'user_id' => Auth::user()->name,
            'service_book' => $booking->service,
            'time_book' => $booking->time,
            'booking_date' => $booking->date,
            'beac_book' => $booking->beautician_name,
            'total_amount' => $booking->price,
            // Add more booking details as needed
        ];
        return view('user-refund', compact('bookingData'));
    }

    public function storeRefund(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'booking_id'=> 'unique:refunds,booking_id',
            'reason' => 'required',
            'additional_info'=>'max:500'

        ],
        [
            'booking_id.unique' => 'ทำเรื่องขอคืนเงินรายการนี้ไปแล้ว',
            'additional_info.max'=>'ป้อนได้ไม่เกิน 500'
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $refundData =[
            'user_id' => Auth::user()->id,
            'booking_id' => $request->booking_id,
            'reason' => $request->reason,
            'addition_info'=>$request->additional_info
        ];
        Refunduser::create($refundData);
        Booking::where('booking_id', $request->booking_id)->update(['payment_status' => 'รอตรวจสอบคืนเงิน']);
        return redirect()->route('queueinfo')->with('toast_success', 'ทำเรื่องร้องขอคืนเงินเรียบร้อย');
    }
}

