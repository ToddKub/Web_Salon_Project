<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class DateIsNotSame implements ValidationRule
{

    protected $bookingId;

    public function __construct($bookingId)
    {
        $this->bookingId = $bookingId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $booking = DB::table('bookings')->where('booking_id', $this->bookingId)->first();
        if ($booking && $booking->date == $value) {
            $fail('วันที่ที่เลือกไม่สามารถเลือกได้');
        }
    }
}
