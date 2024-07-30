<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ความคิดเห็นการให้บริการ') }}
        </h2>
    </x-slot>

    <div class="mx-auto pl-5 my-3 py-2 ">
        <div class="w-full h-full px-4 py-1 -mx-4 sm:-mx-8 sm:px-8 lg:px-6 flex flex-col items-center">
            <div class="inline-block w-full rounded-lg shadow overflow-x-auto">
                <table class="table-auto leading-normal w-full">
                    <thead>
                        <tr>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                รายการ
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ชื่อลูกค้า
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                รหัสรายการคิว
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                บริการ
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                เวลา
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                วัน
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ชื่อช่าง
                            </th>
                            <th class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ความคิดเห็น
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- ส่วนนี้ให้ใส่ข้อมูลลูกค้าที่รับมาจาก Controller โดยใช้ Blade syntax -->
                        @foreach ($comments as $comment)
                            <!-- แสดงข้อมูลลูกค้าแต่ละรายการ -->
                            <tr>
                                <td class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">{{ $comment->id }}</td>
                                <td class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">{{ $comment->name }}</td>
                                <td class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">{{ $comment->booking_id }}</td>
                                <td class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">{{ $comment->service }}</td>
                                <td class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">{{ $comment->time }}</td>
                                <td class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap"><?php
                                    // Convert the date to d:m:Y format using PHP's date function
                                    $date = date('d-m-Y', strtotime($comment->date));
                                    echo $date;
                                    ?></td>
                                <td class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">{{ $comment->beautician }}</td>
                                <td class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">{{ $comment->comment }}</td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
