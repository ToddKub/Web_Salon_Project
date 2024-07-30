<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use Illuminate\Support\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // รายการของบริการที่เป็นไปได้
        $services = ['ต่อขนตา', 'ทำเล็บ', 'ทำคิ้ว '];
        $time =['10.00->12.00',
        '12.00->13.00',
        '14.00->15.00',
        '19.00->20.00'];
        $beautician=['ช่างกี่','ช่างตูมตาม'];
        $price = [1000,2000,3000,4000];
        $paymentstatus=['ชำระเงินแล้ว','ยกเลิกการจอง','ขอคืนเงินแล้ว'];

        // เพิ่มข้อมูลลงในฐานข้อมูล
        for ($i = 0; $i < 10; $i++) {
            Booking::create([
                'service' => $services[array_rand($services)],
                'time' => $time[array_rand($time)],
                'date' => Carbon::now()->addDays(rand(1, 30))->toDateString(), // ใช้วันที่ 3 วันหลังจากวันนี้
                'beautician_name' => $beautician[array_rand($beautician)],
                'user_id' => '6',
                'price' => $price[array_rand($price)],
                'payment_status' => $paymentstatus[array_rand($paymentstatus)],
                
            ]);
        }  
    }
}
