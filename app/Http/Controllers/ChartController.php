<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        $users = User::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $userCounts = array_fill(1, 12, 0);
        foreach ($users as $month => $count) {
            $userCounts[$month] = $count;
        }

        // Booking services data
        $services = Booking::selectRaw('COUNT(*) as count, service')
            ->groupBy('service')
            ->get()
            ->pluck('count', 'service')
            ->toArray();

        $labels = array_keys($services);
        $data = array_values($services);


        //book per month
        //  $currentYear = Carbon::now()->year;
        //$monthss = [];
        //for ($month = 1; $month <= 12; $month++) {
        //  $monthss[] = Carbon::create($currentYear, $month, 1)->translatedFormat('F');
        //}

        $bookingCounts = Booking::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $bookingData = array_fill(1, 12, 0);
        foreach ($bookingCounts as $month => $count) {
            $bookingData[$month] = $count;
        }
        // $bookingData = collect($bookingCounts)->sortKeys()->map(function ($value) {
        //   return (int) $value;
        //})->toArray();

        // เติมค่า 0 ให้กับเดือนที่ไม่มีข้อมูล
        //$bookingData = array_pad($bookingData, 12, 0);

        //sum price
        // ข้อมูลการจองที่มีสถานะต่าง ๆ
        /*$paidAmounts = Booking::where('payment_status', 'ชำระเงินแล้ว')
            ->selectRaw("SUM(price) as total_amount, MONTH(created_at) as month")
            ->groupBy('month')
            ->pluck('total_amount', 'month')
            ->toArray();

        $cancelledAmounts = Booking::where('payment_status', 'ยกเลิกการจอง')
            ->selectRaw("SUM(price) as total_amount, MONTH(created_at) as month")
            ->groupBy('month')
            ->pluck('total_amount', 'month')
            ->toArray();

        $refundedAmounts = Booking::where('payment_status', 'ขอคืนเงินเรียบร้อย')
            ->selectRaw("SUM(price) as total_amount, MONTH(created_at) as month")
            ->groupBy('month')
            ->pluck('total_amount', 'month')
            ->toArray();

        $paidAmountsatshope = Booking::where('payment_status', 'ชำระเงินที่ร้านแล้ว')
            ->selectRaw("SUM(price) as total_amount, MONTH(created_at) as month")
            ->groupBy('month')
            ->pluck('total_amount', 'month')
            ->toArray();
*/

        /* 
        $paidAmounts = Booking::select(DB::raw("SUM(price) as total_amount"))
            ->where('payment_status', 'ชำระเงินแล้ว')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->pluck('total_amount')->toArray();

        $cancelledAmounts = Booking::select(DB::raw("SUM(price) as total_amount"))
            ->where('payment_status', 'ยกเลิกการจอง')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->pluck('total_amount')->toArray();
        $refundAmounts = Booking::select(DB::raw("SUM(price) as total_amount"))
            ->where('payment_status', 'ขอคืนเงินเรียบร้อย')
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()->pluck('total_amount')->toArray();
*/
        $monthss = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];

        $bookingss = Booking::selectRaw('MONTH(created_at) as month, SUM(CASE WHEN payment_status = "ชำระเงินแล้ว" THEN price ELSE 0 END) as paid_amount, SUM(CASE WHEN payment_status = "ยกเลิกการจอง" THEN price ELSE 0 END) as cancelled_amount, SUM(CASE WHEN payment_status = "ขอคืนเงินเรียบร้อย" THEN price ELSE 0 END) as refunded_amount')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();


        $firstMonth = $bookingss->min('month');
        $labelss = [];
        Carbon::setLocale('th');
        foreach (range($firstMonth, 12) as $month) {
            $labelss[] = Carbon::createFromDate(null, $month, null)->translatedFormat('F');
        }
        $paidData = $bookingss->pluck('paid_amount')->prepend(0);
        $cancelledData = $bookingss->pluck('cancelled_amount')->prepend(0);
        $refundedData = $bookingss->pluck('refunded_amount')->prepend(0);

        return view('admin-dashboard', compact('userCounts', 'monthss', 'labels', 'data', 'bookingData', 'labelss', 'paidData', 'cancelledData', 'refundedData'));
    }
}
