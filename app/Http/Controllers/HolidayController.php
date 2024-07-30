<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Holiday;
use Illuminate\View\View;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = DB::table('holidays')->paginate(3);
        return view('admin-date', compact('holidays'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'closed_date' => 'required|unique:holidays,closed_date|date_format:Y-m-d',
            ],
            [
                'closed_date.required' => 'กรุณาเลือกวัน',
                'closed_date.unique' => 'วันที่เลือกได้บันทึกไปแล้ว',
            ]
        );
        $holiday = new Holiday([
            'user_id' => Auth::user()->id,
            'closed_date' => $request->closed_date
        ]);
        $holiday->save();
        return redirect()->back()->with('success', 'บันทึกวันหยุดสำเร็จ');
    }
    public function destroy($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();

    return redirect()->back()->with('success', 'ลบวันหยุดสำเร็จ');
    }
}
