<?php

namespace App\Http\Middleware;

use App\Models\Holiday;
use Closure;
use Illuminate\Http\Request;

class CheckHoliday
{
    public function handle(Request $request, Closure $next)
    {
        $today = date('Y-m-d');
        $selectedDate = $request->input('date');

        if ($selectedDate < $today) {
            return redirect()->back()->with('error', 'ไม่สามารถเลือกวันที่ผ่านมาได้');
        }
        
        if (Holiday::where('date', $selectedDate)->exists()) {
            return redirect()->back()->with('error', 'วันที่ ' . $selectedDate . ' เป็นวันที่หยุดทำการ');
        }
        if (!isset($request->date)) {
            return redirect()->back()->with('error', 'กรุณาเลือกวันที่');
        }

        return $next($request);
    }
    
}   
