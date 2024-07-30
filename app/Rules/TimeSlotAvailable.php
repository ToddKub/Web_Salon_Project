<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use App\Models\AvailableTime;

class TimeSlotAvailable implements ValidationRule
{

    protected $selectedDate;

    public function __construct($selectedDate)
    {
        $this->selectedDate = $selectedDate;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $bookedTimes = DB::table('bookings')
            ->where('date', $this->selectedDate)
            ->pluck('time')
            ->toArray();

        $availableTimes = AvailableTime::pluck('time_slot')->toArray();
        $remainingTimes = array_diff($availableTimes, $bookedTimes);

        if (!in_array($value, $remainingTimes)) {
            $fail('ไม่สามารถเลื่อนไปยังเวลาที่เลือกได้เนื่องจากเวลาที่เลือกไม่ว่าง');
        }
    }
}
