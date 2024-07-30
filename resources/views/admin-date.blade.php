<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('วันหยุดของช่าง') }}
        </h2>
    </x-slot>
    <div class="mx-auto pl-5 my-3 py-3 ">
        <div class="w-full h-full text-center px-4 py-4 -mx-4 sm:-mx-8 sm:px-8 lg:px-6">
            <div class="inline-block rounded-lg shadow overflow-x-auto overflow-y-auto">
                <table class="table-auto leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ID ผู้ลงวันหยุด</th>
                            <th
                                class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                วันที่หยุด</th>
                            <th
                                class=" shrink px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($holidays as $holiday)
                            <tr>
                                <td
                                    class="px-5 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    {{ $holiday->user_id }}
                                </td>
                                <td
                                    class="px-5 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    <?php
                                    $date = date('d-m-Y', strtotime($holiday->closed_date));
                                    echo $date;
                                    ?>
                                </td>
                                <td
                                    class="px-5 py-5 text-sm text-center bg-white border-b border-gray-200 whitespace-nowrap">
                                    <form action="{{ route('holidays.destroy', $holiday->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">ลบ</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{$holidays->links()}}
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('holidays.store') }}" method="POST" class="text-center">
        @csrf
        <div class="form-group py-5 text-center">
            <label for="date">วันที่</label>
            <input type="date" name="closed_date" class="form-control rounded-lg" required>
        </div>
        <button type="submit"
            class="mx-auto max-w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">บันทึก</button>
    </form>
</x-app-layout>
