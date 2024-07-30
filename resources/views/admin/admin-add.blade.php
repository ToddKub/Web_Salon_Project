<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('เพิ่มข้อมูล') }}
        </h2>
    </x-slot>
    <div class="mx-auto pl-5 my-3 py-2">
        <div class="w-full h-full px-4 py-1 -mx-4 sm:-mx-8 sm:px-8 lg:px-6 flex flex-col items-center">
            <!--service-->
            <div class="pt-12 max-w-full text-center px-auto font-bold text-3xl  ">บริการ</div>
            <!-- ปุ่มเปิด Modal addservice -->
            <div class="w-full flex justify-end">
                <button
                    class="inline-block w-auto text-center px-3 py-2 my-2 ml-auto  text-white transition-all bg-blue-600 rounded-md shadow-xl sm:w-auto hover:bg-blue-500 hover:text-white shadow-neutral-300 hover:shadow-2xl hover:shadow-neutral-400 hover:-tranneutral-y-px"
                    x-data @click="$dispatch('open-modal','addservice')"> เพิ่มบริการ
                </button>
            </div>

            {{-- add service --}}
            <x-modal name="addservice">
                <h2 class=" font-bold text-2xl text-gray-900 mt-7 mx-auto w-full text-center">
                    {{ __('เพิ่มบริการ') }}
                </h2>
                <div class="py-4 lg:py-5 px-4 mx-auto max-w-screen-md">
                    <form action="{{ route('services.store') }}" method="POST" class="text-center">
                        @csrf
                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            ชื่อบริการ</p>
                        <input type="text"
                            class="form-control mb-2 w-full mx-auto max-w-md rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="serviceName" name="name">

                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            ข้อมูลเพิ่มเติมบริการ</p>
                        <textarea class="form-control w-full mb-2 max-w-md rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="serviceDescription" name="description"></textarea>

                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            ราคาบริการ</p>
                        <input type="number"
                            class="form-control mb-2 w-full max-w-md rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="servicePrice" name="price">
                        <div
                            class="flex flex-col lg:justify-center sm:flex-row sm:justify-end mt-3 space-y-3 sm:space-y-0 sm:space-x-3">
                            <!-- submit button -->
                            <button type="submit" id ="btn-sub"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                ยืนยัน </button>
                            <!-- Cancel button -->
                            <button @click="$dispatch('close','addservice')" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                ยกเลิก </button>
                        </div>
                    </form>
                </div>
            </x-modal>

            {{-- table service --}}
            <div class="inline-block w-full rounded-lg shadow overflow-x-auto">
                <table class="table-auto leading-normal w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ชื่อบริการ</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ข้อมูลเพิ่มเติม</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ราคา</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    {{ $service->name }}</td>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    {{ $service->description }}</td>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    {{ $service->price }}</td>

                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    <button
                                        class="text-black hover:text-white border border-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 "
                                        x-data @click="$dispatch('open-modal','editservice')"> แก้ไขบริการ
                                    </button>

                                    <div
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        <form action="{{ route('service.destroy', $service->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-black hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                ลบบริการ
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td
                                    class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- edit service --}}
            <x-modal name="editservice">
                <h2 class=" font-bold text-2xl text-gray-900 mt-7 mx-auto w-full text-center">
                    {{ __('แก้ไขบริการ') }}
                </h2>
                <div class="py-4 lg:py-5 px-4 mx-auto max-w-screen-md">
                    <form action="{{ route('service.update', $service->id) }}" method="POST" class="text-center">
                        @method('PUT')
                        @csrf
                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            ชื่อบริการ</p>
                        <input type="text"
                            class="form-control mb-2 w-full mx-auto max-w-md rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="serviceName" name="name">

                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            ข้อมูลเพิ่มเติมบริการ</p>
                        <textarea class="form-control w-full mb-2 max-w-md rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="serviceDescription" name="description"></textarea>

                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            ราคาบริการ</p>
                        <input type="number"
                            class="form-control mb-2 w-full max-w-md rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="servicePrice" name="price">
                        <div
                            class="flex flex-col lg:justify-center sm:flex-row sm:justify-end mt-3 space-y-3 sm:space-y-0 sm:space-x-3">

                            <!-- submit button -->
                            <button type="submit" id ="btn-sub"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                ยืนยัน </button>
                            <!-- Cancel button -->
                            <button @click="$dispatch('close','editservice')" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                ยกเลิก </button>
                        </div>
                    </form>
                </div>
            </x-modal>

            {{-- beauticans --}}
            <div class="w-full h-full px-4 py-1 -mx-4 sm:-mx-8 sm:px-8 lg:px-6 flex flex-col items-center">
                <!--Beauticians-->
                <div class="pt-12 max-w-full text-center px-auto font-bold text-3xl  ">ช่างบริการ</div>
                <!-- ปุ่มเปิด Modal -->
                <div class="w-full flex justify-end ">
                    <button
                        class="inline-block w-auto text-center px-3 py-2 my-2 ml-auto  text-white transition-all bg-blue-600 rounded-md shadow-xl sm:w-auto hover:bg-blue-500 hover:text-white shadow-neutral-300 hover:shadow-2xl hover:shadow-neutral-400 hover:-tranneutral-y-px"
                        x-data @click="$dispatch('open-modal','addbea')"> เพิ่มช่างบริการ
                    </button>
                </div>
                {{-- add beauticans --}}
                <x-modal name="addbea">
                    <h2 class=" font-bold text-2xl text-gray-900 mt-7 mx-auto w-full text-center">
                        {{ __('เพิ่มช่างบริการ') }}
                    </h2>
                    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                        <form action="{{ route('beauticians.store') }}" method="POST" class="text-center">
                            @csrf
                            <p class="text-sm font-semibold text-gray-700 mb-2">
                                ชื่อช่างที่เพิ่ม</p>
                            <input type="text"
                                class="form-control mb-2 w-full mx-auto max-w-md rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="Beautician_name" name="name">
                            <div
                                class="flex flex-col lg:justify-center sm:flex-row sm:justify-end mt-3 space-y-3 sm:space-y-0 sm:space-x-3">

                                <!-- submit button -->
                                <button type="submit" id ="btn-sub"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    ยืนยัน </button>
                                <!-- Cancel button -->
                                <button @click="$dispatch('close','addbea')" type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    ยกเลิก </button>
                            </div>
                        </form>
                    </div>
                </x-modal>


                {{-- -table bea- --}}
                <div class="inline-block w-full rounded-lg shadow overflow-x-auto">
                    <table class="table-auto leading-normal w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                    ชื่อช่าง</th>
                                <th
                                    class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($beauticians as $beautician)
                                <tr>
                                    <td
                                        class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                        {{ $beautician->name }}</td>
                                    </td>
                                    <td
                                        class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">

                                        <button
                                            class="text-black hover:text-white border border-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 "
                                            x-data @click="$dispatch('open-modal','editbea')"> แก้ไขช่าง
                                        </button>

                                        <div>
                                            <form action="{{ route('beautician.destroy', $beautician->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-black hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                    ลบช่าง
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        No beauticians found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <x-modal name="editbea">
                <h2 class=" font-bold text-2xl text-gray-900 mt-7 mx-auto w-full text-center">
                    {{ __('แก้ไขช่าง') }}
                </h2>
                <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                    <form action="{{ route('beautician.update', $beautician->id) }}" method="POST" class="text-center">
                        @method('PUT')
                        @csrf
                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            ชื่อช่าง</p>
                        <input type="text"
                            class="form-control form-control mb-2 w-full mx-auto max-w-lg rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="beauticianname" name="name">
                        <div
                            class="flex flex-col lg:justify-center sm:flex-row sm:justify-end mt-3 space-y-3 sm:space-y-0 sm:space-x-3">
                            <!-- submit button -->
                            <button type="submit" id ="btn-sub"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                ยืนยัน </button>
                            <!-- Cancel button -->
                            <button @click="$dispatch('close','editbea')" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                ยกเลิก </button>
                        </div>

                    </form>
                </div>
            </x-modal>

            {{-- table-bea-non-service --}}
            <div class="w-full h-full px-4 py-1 -mx-4 sm:-mx-8 sm:px-8 lg:px-6 flex flex-col items-center">
                <div class="pt-12 max-w-full text-center px-auto font-bold text-3xl pb-5">ช่างที่ไม่ได้บริการแล้ว</div>
                <div class="inline-block w-full rounded-lg shadow overflow-x-auto">
                    <table class="table-auto leading-normal w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                    ชื่อช่าง</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trashedbeautician as $beautician)
                                <tr>
                                    <td
                                        class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                        {{ $beautician->name }}
                                    </td>
                                @empty
                                <tr>
                                    <td
                                        class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                        ไม่มีข้อมูลช่าง</td>
                                </tr>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- timeslot --}}
            <div class="w-full h-full px-4 py-1 -mx-4 sm:-mx-8 sm:px-8 lg:px-6 flex flex-col items-center">
                <div class="pt-12 max-w-full text-center px-auto font-bold text-3xl pb-5">ช่วงเวลาที่ให้บริการ</div>
                <!-- ปุ่มเปิด Modal -->
                <div class="w-full flex justify-end ">
                    <button
                        class="inline-block w-auto text-center px-3 py-2 my-2 ml-auto  text-white transition-all bg-blue-600 rounded-md shadow-xl sm:w-auto hover:bg-blue-500 hover:text-white shadow-neutral-300 hover:shadow-2xl hover:shadow-neutral-400 hover:-tranneutral-y-px"
                        x-data @click="$dispatch('open-modal','addtime')"> เพิ่มช่วงเวลาบริการ
                    </button>
                </div>

                {{-- add time --}}
                <x-modal name="addtime">
                    <h2 class=" font-bold text-2xl text-gray-900 mt-7 mx-auto w-full text-center">
                        {{ __('เพิ่มช่วงเวลาบริการ') }}
                    </h2>
                    <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                        <form action="{{ route('availabletimes.store') }}" method="POST" class="text-center">
                            @csrf
                            <p class="text-sm font-semibold text-gray-700 mb-2">
                                ช่วงเวลาที่ให้บริการ</p>
                            <input type="text"
                                class="form-control mb-2 w-full mx-auto max-w-md rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                id="availabletimes" name="time_slot">
                            <div
                                class="flex flex-col lg:justify-center sm:flex-row sm:justify-end mt-3 space-y-3 sm:space-y-0 sm:space-x-3">
                                <!-- submit button -->
                                <button type="submit" id ="btn-sub"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    ยืนยัน </button>
                                <!-- Cancel button -->
                                <button @click="$dispatch('close','addtime')" type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    ยกเลิก </button>
                            </div>
                        </form>
                    </div>
                </x-modal>

                {{-- table-time_slot- --}}
                <div class="inline-block w-full rounded-lg shadow overflow-x-auto">
                    <table class="table-auto leading-normal w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                    Time Slot
                                </th>
                                <th
                                    class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($availableTimes as $time)
                                <tr>
                                    <td
                                        class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                        {{ $time->time_slot }}</td>
                                    </td>
                                    <td
                                        class="px-3 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">

                                        <button
                                            class="text-black hover:text-white border border-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                                            x-data @click="$dispatch('open-modal','edittime')"> แก้ไขช่วงเวลา
                                        </button>

                                        <div>
                                            <form action="{{ route('timeslot.destroy', $time->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-black hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                    ลบช่วงเวลานี้
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        No available times found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <x-modal name="edittime">
                <h2 class=" font-bold text-2xl text-gray-900 mt-7 mx-auto w-full text-center">
                    {{ __('แก้ไขช่วงเวลา') }}
                </h2>
                <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                    <form action="{{ route('timeslot.update', $time->id) }}" method="POST" class="text-center">
                        @method('PUT')
                        @csrf
                        <p class="text-sm font-semibold text-gray-700 mb-2">
                            ช่วงเวลา</p>
                        <input type="text" class="form-control mb-2 w-full mx-auto max-w-screen rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" id="time_slot" name="time_slot">
                        <div
                            class="flex flex-col lg:justify-center sm:flex-row sm:justify-end mt-3 space-y-3 sm:space-y-0 sm:space-x-3">

                            <!-- submit button -->
                            <button type="submit" id ="btn-sub"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                ยืนยัน </button>
                            <!-- Cancel button -->
                            <button @click="$dispatch('close','edittime')" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                ยกเลิก </button>
                        </div>
                    </form>
                </div>
            </x-modal>

        </div>
    </div>
    </div>
</x-app-layout>
<
