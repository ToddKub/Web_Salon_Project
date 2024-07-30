<x-appu-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('จองคิว') }}
        </h2>
    </x-slot>
    <div class="py-12 mx-auto">
        <div class=" max-w-full max-h-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg border border-gray-200 shadow-lg">
                <div class="p-6 mx-auto text-gray-900">

                    {{--แสดงฟอร์มสำหรับจองบริการ--}}
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf

                        <!-- เลือกบริการ -->
                        <div class="pb-11">
                            <div class="form-group max-w-sm mx-auto">
                                <label for="service">Service:</label>
                                <select id="service" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="service">
                                    <option value="" disabled selected>กรุณาเลือกบริการ</option>
                                    @foreach($selectService as $service)
                                    <option value="{{$service}}">{{$service}}</option>
                                    @endforeach    
                                </select>
                            </div>
                        </div>
                        <!-- เลือกวันที่ -->
                        <div class="form-group max-w-sm mx-auto pb-11">
                            <label for="date">Date:</label>
                            <input type="date" name="date" id="date" class="form-contro bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500l"
                                value="{{ $selectedDate }}" placeholder="เลือกวันที่">
                        </div>
    

                            <!-- เลือกเวลา -->
                        <div class="form-group max-w-sm mx-auto pb-11">
                            <label for="time">Time:</label>
                            <select name="time" id="time" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($availableTimes as $time)
                                    @if (!in_array($time, $bookedTimes))
                                        @php
                                            $alreadyBooked = false;
                                        @endphp
                                        @foreach($bookings as $booking)
                                            @if ($booking->service == $request->service && $booking->time == $time)
                                                @php
                                                    $alreadyBooked = true;
                                                    break;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if (!$alreadyBooked)
                                            <option value="{{ $time }}">{{ $time }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- เลือกช่าง -->
                        <div class="form-group max-w-sm mx-auto pb-11">
                            <label for="beautician_name">Beautician Name:</label>
                            <select name="beautician_name" id="beautician_name" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($availableBeauticians as $beautician)
                                    @if (!in_array($beautician, $bookedBeauticians))
                                        @php
                                            $alreadyBooked = false;
                                        @endphp
                                        @foreach($bookings as $booking)
                                            @if ($booking->service == $request->service && $booking->beautician_name == $beautician)
                                                @php
                                                    $alreadyBooked = true;
                                                    break;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if (!$alreadyBooked)
                                            <option>{{ $beautician }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group max-w-sm mx-auto pb-11">
                            <label>ราคา:</label>
                            <span id="price" class="text-gray-900 text-sm"></span>
                        </div>
                        
                        <script>
                            const servicesPrices = @json($servicesPrices);
                            const serviceSelect = document.getElementById('service');
                            const priceSpan = document.getElementById('price');
                        
                            serviceSelect.addEventListener('change', () => {
                                const selectedService = serviceSelect.value;
                                const price = servicesPrices[selectedService] || 0;
                                priceSpan.textContent = `${price} บาท`;
                            });
                        </script>

                        <!--radio ราคา-->
                        <div class="max-w-sm mx-auto pb-11">
                            <label>วิธีการชำระเงิน:</label><br>
                            <input type="radio" id="full_payment" name="payment_mode" value="full" checked >
                            <label for="full_payment">ชำระเงินทั้งหมด</label>
                            <br>
                            <input type="radio" id="half_payment" name="payment_mode" value="paylater" >
                            <label for="half_payment">ชำระที่ร้าน</label>
                        </div>
                        <!-- ปุ่ม Submit สำหรับจองคิว -->
                        <div class=" max-w-sm mx-auto text-center">   
                            <button type="submit" class="inline-block w-auto text-center px-3 py-2 text-white transition-all bg-gray-700 dark:bg-white dark:text-gray-800 rounded-md shadow-xl sm:w-auto hover:bg-gray-900 hover:text-white shadow-neutral-300 dark:shadow-neutral-700 hover:shadow-2xl hover:shadow-neutral-400 hover:-tranneutral-y-px">จองคิว</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-appu-layout>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // ใช้ flatpickr แทน jQuery UI datepicker
    flatpickr("#date", {
        minDate: "today", // ไม่ให้เลือกวันในอดีต               
        disable: {!! json_encode($disabled_dates) !!} // กำหนดวันที่ที่ไม่สามารถเลือกได้จากฐานข้อมูล
    });
</script>
