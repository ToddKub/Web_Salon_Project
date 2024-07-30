<x-appu-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('รายละเอียดการจอง') }}
        </h2>
    </x-slot>
    <div class="mx-auto pl-5 my-3 py-2 ">
        <div class="w-full h-full px-4 py-1 -mx-4 sm:-mx-8 sm:px-8 lg:px-6 flex flex-col items-center">
            <div class="inline-block w-full rounded-lg shadow overflow-x-auto">
                <table class="table-auto leading-normal w-full" id="user-info">
                    <thead>
                        <tr>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('booking_id', 'รหัสรายการ')
                            </th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200">
                                @sortablelink('service', 'บริการ')
                            </th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200">
                                @sortablelink('time', 'เวลาที่จอง')
                            </th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('date', 'วันที่จอง')
                            </th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('beautician_name', 'ช่างที่จอง')
                            </th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200">
                                @sortablelink('payment_status', 'สถานะ')
                            </th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('price', 'ยอดเงิน')
                            </th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($queueinfo as $queue)
                            <tr>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    {{ $queue->booking_id }}
                                </td>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    {{ $queue->service }}
                                </td>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    {{ $queue->time }}
                                </td>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    <?php
                                    // Convert the date to d:m:Y format using PHP's date function
                                    $date = date('d-m-Y', strtotime($queue->date));
                                    echo $date;
                                    ?>
                                </td>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    {{ $queue->beautician_name }}
                                </td>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full">
                                        @if ($queue->payment_status === 'รอชำระเงิน')
                                            <span
                                                class="px-2 py-2 text-yellow-800 bg-yellow-500 rounded-3xl">รอชำระเงิน</span>
                                        @elseif ($queue->payment_status === 'ชำระเงินแล้ว')
                                            <span
                                                class="px-2 py-2 text-green-600 bg-green-100 rounded-3xl">ชำระเงินแล้ว</span>
                                        @elseif($queue->payment_status === 'จ่ายที่หลัง')
                                            <span
                                                class="px-2 py-2 text-blue-600 bg-blue-300 rounded-3xl">ชำระที่ร้าน</span>
                                        @elseif($queue->payment_status === 'ขอคืนเงินแล้ว')
                                            <span
                                                class="px-2 py-2 text-pink-600 bg-pink-300 rounded-3xl">ขอคืนเงินเรียบร้อย</span>
                                        @elseif($queue->payment_status === 'ชำระเงินที่ร้านเแล้ว')
                                            <span
                                                class="px-2 py-2 text-green-600 bg-green-300 rounded-3xl">ชำระเงินที่ร้านเแล้ว</span>
                                        @elseif($queue->payment_status === 'รอตรวจสอบคืนเงิน')
                                            <span
                                                class="px-2 py-2 text-purple-600 bg-purple-300 rounded-3xl">รอตรวจสอบคืนเงิน</span>
                                        @else
                                            <span
                                                class="px-2 py-2 text-gray-500 bg-gray-200 rounded-3xl">สถานะไม่ถูกต้อง</span>
                                        @endif
                                    </span>
                                </td>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    {{ $queue->price }}
                                </td>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    <div class="flex flex-col space-y-2">
                                        @if ($queue->payment_status === 'รอชำระเงิน')
                                            <form action="{{ route('checkout') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="price" value={{ $queue->price }}>
                                                <input type="hidden" name="booking_id" value={{ $queue->booking_id }}>
                                                <input type="hidden" name="service_queue"value={{ $queue->service }}>
                                                <input type="hidden" name="date_queue"value={{ $queue->date }}>
                                                <input type="hidden" name="time_queue"value={{ $queue->time }}>
                                                <input type="hidden"
                                                    name="beautician_name_queue"value={{ $queue->beautician_name }}>
                                                <!-- ปุ่มชำระเงิน -->
                                                <button
                                                    class="text-black hover:text-white border border-green-600 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-4 dark:border-green-500 dark:text-green-500 dark:hover:text-black dark:hover:bg-green-600 dark:focus:ring-green-900">
                                                    ชำระเงิน</button>
                                            </form>
                                        @endif
                                        @if ($queue->payment_status !== 'ขอคืนเงินแล้ว')
                                            {{-- ปุ่มเลื่อนวันจอง --}}
                                            @if ($queue->payment_status !== 'รอตรวจสอบคืนเงิน' && $queue->payment_status !== 'รอชำระเงิน')
                                                <button
                                                    class="text-black hover:text-white border border-yellow-400 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center me-2 mb-3 mt-2"
                                                    x-data
                                                    @click="$dispatch('open-modal','reschedule-{{ $queue->booking_id }}')">
                                                    เลื่อนวันจอง
                                                </button>
                                            @endif
                                            <!-- Modal -->
                                            <x-modal name="reschedule-{{ $queue->booking_id }}">
                                                <h2 class=" font-bold text-2xl text-gray-900 mt-7 w-full">
                                                    {{ __('เลื่อนวันจอง') }}
                                                </h2>
                                                <div class="py-4 lg:py-5 px-4 mx-auto max-w-screen-md">
                                                    <form action="{{ route('queueinfo.update', $queue->booking_id) }}"
                                                        method="POST" id="form-update">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="mt-2">
                                                            <p class="text-sm text-gray-700 mb-2">
                                                                กรุณาเลือกวันที่ต้องการ
                                                            </p>
                                                            <input type="date" id="new_date" name="new_date"
                                                                class="rounded-lg focus:ring-2 focus:ring-blue-600"
                                                                placeholder="เลือกวันที่ต้องการเลื่อน">
                                                        </div>
                                                        <div class="mt-2">
                                                            <p class="text-sm text-gray-700 mb-2">
                                                                เวลาที่ต้องการเลื่อน</p>
                                                            <select id="new_time" name="new_time"
                                                                class="rounded-lg mb-3" required>
                                                                @foreach ($availableTimes as $availableTime)
                                                                    <option value="{{ $availableTime->time_slot }}">
                                                                        {{ $availableTime->time_slot }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div
                                                            class="flex flex-col lg:justify-center sm:flex-row sm:justify-end mt-3 space-y-3 sm:space-y-0 sm:space-x-3">
                                                            <!-- submit button -->
                                                            <button type="submit" id ="btn-sub"
                                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                                ยืนยัน </button>
                                                            <!-- Cancel button -->
                                                            <button
                                                                @click="$dispatch('close','reschedule-{{ $queue->booking_id }}')"
                                                                type="button"
                                                                class="mt-3 w-full inline-flex justify-center rounded-md border border-red-300 bg-red-500 shadow-sm px-4 py-2 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                                ยกเลิก </button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </x-modal>


                                            <!-- ปุ่มแสดงความคิดเห็น -->
                                            @php
                                                $currentDate = \Carbon\Carbon::now();
                                            @endphp
                                            @if (
                                                ($queue->payment_status === 'ชำระเงินแล้ว' || $queue->payment_status === 'ชำระเงินที่ร้านเแล้ว') &&
                                                    isset($queue->date) &&
                                                    \Carbon\Carbon::parse($queue->date)->isPast())
                                                <!-- ปุ่มเปิด Modal -->
                                                {{-- Check if comment has already been made --}}
                                                @if (!$commentsStatus[$queue->booking_id])
                                                    <button
                                                        class="text-black hover:text-white border border-blue-400 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center me-2 mb-3 mt-2"
                                                        x-data
                                                        @click="$dispatch('open-modal','comment-{{ $queue->booking_id }}')">
                                                        แสดงความคิดเห็น
                                                    </button>
                                                @endif
                                                <!-- Modal -->
                                                <x-modal name="comment-{{ $queue->booking_id }}">
                                                    <h2 class=" font-bold text-2xl text-gray-900 mt-7 w-full">
                                                        {{ __('แสดงความคิดเห็น') }}
                                                    </h2>
                                                    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                                                        <form action="{{ route('comment.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="booking_id"
                                                                value="{{ $queue->booking_id }}">
                                                            <textarea name="comment" placeholder="กรุณากรอกความคิดเห็น" class="resize rounded-lg"></textarea>
                                                            <div
                                                                class="flex flex-col lg:justify-center sm:flex-row sm:justify-end mt-3 space-y-3 sm:space-y-0 sm:space-x-3">
                                                                <!-- submit button -->
                                                                <button type="submit" id ="btn-sub"
                                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                                    ยืนยัน </button>
                                                                <!-- Cancel button -->
                                                                <button
                                                                    @click="$dispatch('close','comment-{{ $queue->booking_id }}')"
                                                                    type="button"
                                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                                    ยกเลิก </button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </x-modal>
                                            @endif

                                            <!-- ปุ่มยกเลิก -->
                                            @if ($queue->payment_status === 'รอชำระเงิน')
                                                <a href="{{ route('queuedelete', $queue->booking_id) }}"
                                                    class="text-black hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-400 font-medium rounded-lg text-sm px-2 py-2.5 text-center me-2 mb-3 mt-2"
                                                    data-confirm-delete = "true">ยกเลิก</a>
                                            @endif
                                            <!--check date-->

                                            @php
                                                $currentDate = now();
                                                $bookingDate = \Carbon\Carbon::parse($queue->date);
                                                $refundAllowedDate = $bookingDate->subDays(1);
                                            @endphp

                                            @if ($queue->payment_status === 'ชำระเงินแล้ว' && $currentDate < $refundAllowedDate)
                                                <a href="{{ route('refund.form', $queue->booking_id) }}"
                                                    class="text-black hover:text-white border border-pink-600 hover:bg-pink-600 focus:ring-4 focus:outline-none focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-3 mt-2 dark:border-pink-500 dark:text-pink-500 dark:hover:text-white dark:hover:bg-pink-600 dark:focus:ring-pink-900">
                                                    ขอคืนเงิน
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $queueinfo->appends(Request::except('page'))->links() }}{{-- อย่าลืม s ต่อท้าย Link --}}
            </div>
        </div>
    </div>

</x-appu-layout>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // กำหนด datepicker และการเปิดเมื่อคลิกที่ปุ่ม
    flatpickr("#new_date", {
        minDate: "today", // ไม่ให้เลือกวันในอดีต               
        disable: {!! json_encode($disabled_dates) !!}, // กำหนดวันที่ที่ไม่สามารถเลือกได้จากฐานข้อมูล
        onClose: function(selectedDates, dateStr, instance) {
            // ซ่อน datepicker เมื่อเลือกวันเสร็จแล้ว
            instance.close();
        }
    });
</script>
