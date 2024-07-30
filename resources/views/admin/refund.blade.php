<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('รายการขอคืนเงิน') }}
        </h2>
    </x-slot>
    <div class="py-2 pl-5 mx-auto my-3">
        <div class="w-full h-full px-4 py-1 -mx-4 sm:-mx-8 sm:px-8 lg:px-6 flex flex-col items-center">
            <div class="inline-block w-full rounded-lg shadow overflow-x-auto">
                <table class="table-auto leading-normal w-full" id="tabel-refund">
                    <thead>
                        <tr>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                รหัสรายการ</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200">
                                รหัสรายการคิวขอคืนเงิน</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                เหตุผล</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ข้อความเพิ่มเติม</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                สถานะ</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ID ผู้ขอคืนเงิน</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">
                                ชื่อผู้ขอคืนเงิน</th>
                            <th
                                class="px-3 py-3 text-xs font-semibold tracking-wider text-center text-gray-800 uppercase bg-gray-200 border-b-2 border-gray-200 whitespace-nowrap">

                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 w-full text-center">
                        @foreach ($refunds as $refund)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $refund->id }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm  font-medium text-gray-800 dark:text-gray-200">
                                    {{ $refund->booking_id }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm  font-medium text-gray-800 dark:text-gray-200">
                                    {{ $refund->reason }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm  font-medium text-gray-800 dark:text-gray-200">
                                    {{ $refund->addition_info }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">

                                    <span class="px-2 py-1 text-xs text-center font-semibold rounded-full">
                                        @if ($refund->status === 'pending')
                                            <span
                                                class="px-2 py-2 text-yellow-800 bg-yellow-500 rounded-3xl">รอดำเนินการ</span>
                                        @elseif ($refund->status === 'approved')
                                            <span
                                                class="px-2 py-2 text-green-600 bg-green-100 rounded-3xl">ดำเนินการแล้ว</span>
                                        @elseif ($refund->status === 'rejected')
                                            <span
                                                class="px-2 py-2 text-red-600 bg-red-100 rounded-3xl">ปฏิเสธ</span>
                                        @else
                                            <span
                                                class="px-2 py-2 text-gray-500 bg-gray-200 rounded-3xl">สถานะไม่ถูกต้อง</span>
                                        @endif
                                    </span>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm  font-medium text-gray-800 dark:text-gray-200">
                                    {{ $refund->user_id }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm  font-medium text-gray-800 dark:text-gray-200">
                                    {{ $refund->user->name }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    <form method="POST" action="{{ route('admin.refundupdate', $refund->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" name="action" value="approve"
                                            class="btn inline-block w-auto text-center px-3 py-2 text-white transition-all bg-green-500 dark:bg-white dark:text-gray-800 rounded-md shadow-xl sm:w-auto hover:bg-green-700 hover:text-white shadow-neutral-300 dark:shadow-neutral-700 hover:shadow-2xl hover:shadow-neutral-400 hover:-tranneutral-y-px">ยืนยัน</button>
                                        <button type="submit" name="action" value="reject"
                                            class="btn inline-block w-auto text-center px-3 py-2 text-white transition-all bg-red-500 dark:bg-white dark:text-gray-800 rounded-md shadow-xl sm:w-auto hover:bg-red-900 hover:text-white shadow-neutral-300 dark:shadow-neutral-700 hover:shadow-2xl hover:shadow-neutral-400 hover:-tranneutral-y-px">ปฎิเสธ</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $refunds->links() }}{{-- อย่าลืม s ต่อท้าย Link --}}
            </div>
        </div>
    </div>
</x-app-layout>
