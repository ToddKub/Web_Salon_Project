<?php

namespace App\Http\Controllers;
use App\Models\Holiday;
use Illuminate\Http\Request;

class DatePickerController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลวันที่ที่ไม่สามารถเลือกได้จากฐานข้อมูล
        $disabled_dates = Holiday::pluck('closed_date')->toArray();

        return view('datepicker', compact('disabled_dates'));
    }
}
