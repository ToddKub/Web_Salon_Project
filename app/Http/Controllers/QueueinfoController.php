<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Models\Holiday;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;
use App\Models\AvailableTime;
use App\Models\Comment;
use Kyslik\ColumnSortable\Sortable;


class QueueinfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $queueinfo = Booking::where('user_id', $userId)
            ->sortable(['booking_id' => 'desc'])
            ->paginate(5);


        $disabled_dates = Holiday::pluck('closed_date')->toArray();
        $availableTimes = AvailableTime::all();


        $title = 'ยกเลิกการจอง';
        $text = "คุณต้องการที่จะยกเลิกการจองใช้ไหม?";
        confirmDelete($title, $text);

        $commentsStatus = [];

        // Check for each booking if a comment exists
        foreach ($queueinfo as $queue) {
            $hasComment = Comment::where('booking_id', $queue->booking_id)->exists();
            $commentsStatus[$queue->booking_id] = $hasComment;
        }

        return view('userinfo-queue', ['queueinfo' => $queueinfo, 'disabled_dates' => $disabled_dates, 'availableTimes' => $availableTimes,'commentsStatus' => $commentsStatus]);
    }
    public function delete($booking_id)
    {

        $booking = Booking::where('booking_id', $booking_id)->firstOrFail();
        $booking->payment_status = 'ยกเลิกการจอง';
        $booking->save();
        $booking = Booking::where('booking_id', $booking_id)->firstOrFail();
        $booking->delete();
        Alert::success('ยกเลิกการจอง', 'ยกเลิกการจองบริการเรียบร้อย');
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {

        // รับ id และวันที่ที่เลือก
        $selectedDate = request()->get('new_date');
        $selectedTime = request()->get('new_time');


        // ตรวจสอบว่าวันที่ไม่ใช่วันเดิม
        // $booking = DB::table('bookings')->where('booking_id', $id)->first();
        // if ($booking->date == $selectedDate) {
        //   Alert::error('อัปเดตข้อมูล', 'วันที่เลือกไม่สามารถเลือกได้');
        // return redirect('/queueinfo');
        // }

        if (empty($selectedDate)) {
            return redirect()->back()->with('error', 'กรุณาเลือกวันที่เลื่อน');
        }

        // ตรวจสอบว่ามีการจองครบทุกเวลาหรือไม่
        $bookedTimes = DB::table('bookings')
            ->where('date', $selectedDate)
            ->pluck('time')
            ->toArray();

        $availableTimes = AvailableTime::pluck('time_slot')->toArray();

        $remainingTimes = array_diff($availableTimes, $bookedTimes);

        if (empty($remainingTimes)) {
            Alert::error('อัปเดตข้อมูล', 'ไม่สามารถเลื่อนเวลาได้เนื่องจากมีการจองครบทุกเวลา');
            return redirect('/queueinfo');
        }

        // ตรวจสอบว่าเวลาที่เลือกอยู่ในเวลาที่ว่าง
        if (!in_array($selectedTime, $remainingTimes)) {
            Alert::error('อัปเดตข้อมูล', 'ไม่สามารถเลื่อนไปยังเวลาที่เลือกได้เนื่องจากเวลาที่เลือกไม่ว่าง');
            return redirect('/queueinfo');
        }

        // อัปเดตวันที่
        DB::table('bookings')->where('booking_id', $id)->update([
            'date' => $selectedDate,
            'time' => $selectedTime
        ]);

        Alert::success('อัปเดตข้อมูล', 'วันที่จองถูกอัปเดตเรียบร้อยแล้ว');
        return redirect()->back();
    }
}
