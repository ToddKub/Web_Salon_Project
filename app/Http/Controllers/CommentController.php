<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beautician;
use Illuminate\Support\Facades\DB;
use App\Models\Comment; // เพิ่มการนำเข้าโมเดล Comment
use App\Models\Booking; // เพิ่มการนำเข้าโมเดล Booking

class CommentController extends Controller
{
    public function showComment()
    {
        $comments = DB::table('comments')->select('booking_id', 'user_id', 'name', 'email', 'service', 'time', 'date', 'beautician', 'payment_status', 'comment')->get(); // เพิ่มคอลัมน์ 'id' ที่เรียกมาด้วย
        $Beauticians = Beautician::all()->pluck('name')->toArray();
        return view('comments', ['comments' => $comments, 'Beauticians' => $Beauticians]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,booking_id',
            'comment' => 'nullable|max:1000',
        ]
    );

        $booking = Booking::findOrFail($request->booking_id);

        $comment = new Comment([
            'booking_id' => $booking->booking_id,
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'service' => $booking->service,
            'time' => $booking->time,
            'date' => $booking->date,
            'beautician' => $booking->beautician_name,
            'comment' => $request->comment,
        ]);


        $comment->save();

        return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
}
