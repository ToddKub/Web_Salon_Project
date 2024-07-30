<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('รายการจองคิว') }}
        </h2>
    </x-slot>
    <div class="mx-auto pl-5 my-3 py-2 ">
        <div class="w-full h-full px-4 py-1 -mx-4 sm:-mx-8 sm:px-8 lg:px-6 flex flex-col items-center">
            <div class="inline-block w-full rounded-lg shadow overflow-x-auto">
                <table class="table-auto leading-normal w-full" id="table-booking">
                    <thead>
                        <tr>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('booking_id', 'รหัสรายการ')
                            </th>
                            <th 
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('user_id', 'รหัสลูกค้า')
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('service', 'บริการ')
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('time', 'เวลาจองคิว')
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('date', 'วันที่จองคิว')
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('beautician_name', 'ชื่อช่าง')
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                @sortablelink('payment_status', 'สถานะ')
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ดำเนินการ
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-3 py-3 text-center whitespace-nowrap">{{ $booking->booking_id }}</td>
                                <td class="px-3 py-3 text-center whitespace-nowrap">{{ $booking->user_id }}</td>
                                <td class="px-3 py-3 text-center whitespace-nowrap">{{ $booking->service }}</td>
                                <td class="px-3 py-3 text-center whitespace-nowrap">{{ $booking->time }}</td>
                                <td class="px-3 py-3 text-center whitespace-nowrap"><?php
                                // Convert the date to d:m:Y format using PHP's date function
                                $date = date('d-m-Y', strtotime($booking->date));
                                echo $date;
                                ?></td>
                                </td>
                                <td class="px-3 py-3 text-center whitespace-nowrap">{{ $booking->beautician_name }}</td>
                                <td class="px-3 py-3 text-center whitespace-nowrap">
                                    <span class="rounded-full px-2 py-1 text-xs font-semibold">
                                        @if ($booking->payment_status === 'รอชำระเงิน')
                                            <span
                                                class="bg-yellow-500 text-yellow-800 rounded-3xl px-2 py-2">รอชำระเงิน</span>
                                        @elseif ($booking->payment_status === 'ชำระเงินแล้ว')
                                            <span
                                                class="bg-green-100 text-green-600 rounded-3xl px-2 py-2">ชำระเงินแล้ว</span>
                                        @elseif($booking->payment_status === 'จ่ายที่หลัง')
                                            <span
                                                class="bg-blue-300 text-blue-600 rounded-3xl px-2 py-2">ชำระที่ร้าน</span>
                                        @elseif($booking->payment_status === 'ขอคืนเงินแล้ว')
                                            <span
                                                class="bg-pink-300 text-pink-600 rounded-3xl px-2 py-2">ขอคืนเงินเรียบร้อย</span>
                                        @elseif($booking->payment_status === 'ชำระเงินที่ร้านเแล้ว')
                                            <span
                                                class="bg-green-300 text-green-600 rounded-3xl px-2 py-2">ชำระเงินที่ร้านเแล้ว</span>
                                        @elseif($booking->payment_status === 'รอตรวจสอบคืนเงิน')
                                            <span
                                                class="bg-purple-300 text-purple-600 rounded-3xl px-2 py-2">รอตรวจสอบคืนเงิน</span>
                                        @else
                                            <span
                                                class="bg-gray-200 text-gray-500 rounded-3xl px-2 py-2">สถานะไม่ถูกต้อง</span>
                                        @endif
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <!-- ปุ่มเรียก Modal เพื่อเลื่อนข้อมูล -->
                                    <button type="button" onclick="openModal('{{ $booking->booking_id }}')"
                                        class="text-black hover:text-white border border-yellow-400 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-4 mt-3 dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-600 dark:focus:ring-yellow-900">
                                        แก้ไขคิว
                                    </button>
                                    <!-- ปุ่มสำหรับยกเลิกการจองคิว -->
                                    @if ($booking->payment_status == 'รอชำระเงิน')
                                    <form id="deleteForm-{{ $booking->booking_id }}"
                                        action="{{ route('bookings.destroy', $booking->booking_id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="let confirmDelete = confirm('คุณแน่ใจหรือไม่ที่ต้องการลบข้อมูลนี้?'); if(confirmDelete) { redirect(); }"
                                            class="text-black hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            ยกเลิก
                                        </button>
                                    </form>
                                    @endif
                                    <!---ปุ่มยืนยันชำระเงิน--->
                                    @if ($booking->payment_status == 'จ่ายที่หลัง')
                                        <form action="{{ route('bookings.updatepayment', $booking->booking_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="text-black whitespace-nowrap hover:text-white border border-green-400 hover:bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-4 mt-3 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-900">
                                                ยืนยันชำระเงิน
                                            </button>
                                        </form>
                                    @endif
                                </td>
                                    <style>
                                        .modal-overlay {
                                            display: none;
                                            position: fixed;
                                            top: 0;
                                            left: 0;
                                            height: 100%;
                                            width: 100%;
                                            background-color: rgba(0, 0, 0, 0.5);
                                        }

                                        .modal-content {
                                            position: fixed;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            background-color: #fff;
                                            padding: 20px;
                                            border-radius: 8px;
                                            width: 500px;
                                        }
                                    </style>


                                    <div id="modal-{{ $booking->booking_id }}" class="modal-overlay">
                                        <div class="modal-content">
                                            <h2 class="text-lg leading-6 font-bold text-gray-900 text-center mb-3" id="modal-headline">
                                                แก้ไขข้อมูลการจองคิว</h2>
                                            <form action="{{ route('bookings.update', $booking->booking_id) }}"
                                                method="POST" id="editForm-{{ $booking->booking_id }}">
                                                @csrf
                                                @method('PUT')
                                                <label for="service-{{ $booking->booking_id }}"
                                                    class="text-sm text-gray-800 block text-center mb-1">บริการ</label>
                                                <select name="service" id="service-{{ $booking->booking_id }}"
                                                    class="block mx-auto rounded-xl">
                                                    @foreach($selectService as $selservice)
                                                    <option value="{{$selservice}}"  {{ $booking->service == $selservice ? 'selected' : '' }}>
                                                        {{$selservice}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                
                                                <div class="mt-2 mx-28">
                                                    <label for="time-{{ $booking->booking_id }}"
                                                        class="text-sm text-gray-800 block text-center mb-1">เวลาจองคิว</label>
                                                    <select name="time" id="time-{{ $booking->booking_id }}"
                                                        class="block mx-auto rounded-xl">
                                                        @foreach($availableTimes as $avatimes)
                                                        <option value="{{ $avatimes }}" {{ $booking->time == $avatimes ? 'selected' : '' }}>{{ $avatimes }}</option>
                                                           @endforeach    
                                                    </select>
                                                </div>
                                                <div class="mt-2 mx-28">
                                                    <label for="date-{{ $booking->booking_id }}"
                                                        class="text-sm text-gray-800 block text-center mb-1">วันที่จองคิว</label>
                                                    <input type="date" name="date"
                                                        id="date-{{ $booking->booking_id }}"
                                                        value="{{ $booking->date }}" class="block mx-auto rounded-xl">
                                                </div>
                                                <div class="mt-2 mx-28">
                                                    <label for="beautician-{{ $booking->booking_id }}"
                                                        class="text-sm text-gray-800 block text-center mb-1">ชื่อช่าง</label>
                                                    <select name="beautician_name"
                                                        id="beautician-{{ $booking->booking_id }}"
                                                        class="block mx-auto rounded-xl max-w-md">
                                                        @foreach($availableBeauticians as $avabeau)
                                                        <option value="{{$avabeau}}" {{ $booking->beautician_name == $avabeau ? 'selected' : '' }}>
                                                            {{$avabeau}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mt-2 mx-28 flex justify-center">
                                                    <button type="submit"
                                                        onclick="saveBooking('{{ $booking->booking_id }}')"
                                                        class="bg-green-500 hover:bg-green-700 px-4 py-2 mx-2 my-2 rounded-xl drop-shadow-lg border border-gray-800">
                                                        บันทึก
                                                    </button>
                                                    <button type="button"
                                                        onclick="closeModal('{{ $booking->booking_id }}')"
                                                        class="bg-red-500 hover:bg-red-700 px-4 py-2 mx-2 my-2 rounded-xl drop-shadow-lg border border-gray-800">
                                                        ยกเลิก
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <script>
                                    function openModal(bookingId) {
                                        var modal = document.getElementById('modal-' + bookingId);
                                        modal.style.display = "block";
                                    }

                                    function closeModal(bookingId) {
                                        var modal = document.getElementById('modal-' + bookingId);
                                        modal.style.display = "none";
                                    }

                                    function saveBooking(bookingId) {
                                        var editForm = document.getElementById('editForm-' + bookingId);
                                        // บันทึกข้อมูล
                                        editForm.submit();
                                        // เพิ่มข้อความแสดงถึงการบันทึกข้อมูลเรียบร้อยแล้ว
                                        // ปิด Modal หลังจากบันทึกข้อมูล
                                        closeModal(bookingId);
                                        // Redirect ไปที่หน้า index
                                        redirect();
                                    }

                                    function redirect() {
                                        window.location.href = '{{ route('bookings.index') }}';
                                    }
                                </script>

                                <script>
                                    // เพิ่ม function redirect เพื่อกลับไปที่หน้า index
                                    function redirect() {
                                        window.location.href = '{{ route('bookings.index') }}';
                                    }
                                </script>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
            <div class="mt-2">
                {{ $bookings->appends(Request::except('page'))->links() }}
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</x-app-layout>
