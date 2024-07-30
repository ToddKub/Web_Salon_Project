<x-appu-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Refund') }}
        </h2>
    </x-slot> 
    <div class="py-12 mx-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg border border-gray-200 shadow-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row justify-content-center grid grid-cols-2 gap-2">
                            <div>
                                
                                <h1>รายละเอียดการขอคืนเงิน</h1>
                                <li>1.ไม่สามารถขอคืนเงินก่อนวันที่จอง 1 วัน</li>
                                <li>2.การชำระเงินที่ร้านไม่สามารถขอคืนเงินได้</li>
                                <li>3.เมื่อทำการชำระเงิน <br>แล้ว ไม่ได้เข้ามาใช้บริการในวันที่จองไม่สามารถขอคืนเงินได้</li>
                                <li>4.เมื่อทำเรื่องขอคืนเงินแล้วจะไม่สามารถเลื่อนเวลาหรือยกเลิกขอการคืนเงินได้ โปรดตรวจสอบให้แน่ใตก่อนยืนยัน</li>
            
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('refund.store') }}" method="POST">
                                            @csrf
                                            <div class="card-header font-bold">รายละเอียดรายการ</div>

                                            <div class="card-body">
                          
                                                <div class="py-4 border-b border-gray-600 flex items-start justify-between">
                                                    <div class="flex items-center justify-items-start">
                                                        <p class="font-bold text-base leading-4 text-black dark:text-gray-500">รหัสรายการ</p>
                                                    </div>
                                                    <div class="flex items-center justify-items-start">
                                                      <p class="text-sm leading-none text-black dark:text-gray-500 mr-3" id="booking_id">{{ $bookingData['id'] }}</p>
                                                    </div>
                                                  </div>

                                                  <input type="hidden" value="{{ $bookingData['id'] }}" name="booking_id">
                        
                                                  <div class="py-4 border-b border-gray-600 flex items-center justify-between">
                                                    <div class="flex items-center justify-items-center">
                                                        <p class="font-bold text-base leading-4 text-black dark:text-gray-500">ผู้ใช้งาน</p>
                                                    </div>
                                                    <div class="flex items-center justify-items-center">
                                                      <p class="text-sm leading-none text-black dark:text-gray-500 mr-3" id="user_id">{{ $bookingData['user_id'] }}</p>
                                                    </div>
                                                  </div>

                                                  <div class="py-4 border-b border-gray-600 flex items-start justify-between">
                                                    <div class="flex items-center justify-items-start">
                                                        <p class="font-bold text-base leading-4 text-black dark:text-gray-500">บริการ</p>
                                                    </div>
                                                    <div class="flex items-center justify-items-start">
                                                      <p class="text-sm leading-none text-black dark:text-gray-500 mr-3" id="service_book">{{ $bookingData['service_book'] }}</p>
                                                    </div>
                                                  </div>

                                                  <div class="py-4 border-b border-gray-600 flex items-start justify-between">
                                                    <div class="flex items-center justify-items-start">
                                                        <p class="font-bold text-base leading-4 text-black dark:text-gray-500">ช่วงเวลาที่จอง</p>
                                                    </div>
                                                    <div class="flex items-center justify-items-start">
                                                      <p class="text-sm leading-none text-black dark:text-gray-500 mr-3" id="time_book">{{ $bookingData['time_book'] }}</p>
                                                    </div>
                                                  </div>

                                                  <div class="py-4 border-b border-gray-600 flex items-start justify-between">
                                                    <div class="flex items-center justify-items-start">
                                                        <p class="font-bold text-base leading-4 text-black dark:text-gray-500">วันที่จอง</p>
                                                    </div>
                                                    <div class="flex items-center justify-items-start">
                                                      <p class="text-sm leading-none text-black dark:text-gray-500 mr-3" id="booking_date">@php
                                                        $bookingDate = Carbon\Carbon::parse($bookingData['booking_date']);
                                                        echo $bookingDate->format('d-m-Y');
                                                      @endphp</p>
                                                    </div>
                                                  </div>  
                                                  
                                                  <div class="py-4 border-b border-gray-600 flex items-start justify-between">
                                                    <div class="flex items-center justify-items-start">
                                                        <p class="font-bold text-base leading-4 text-black dark:text-gray-500">ช่างที่บริการ</p>
                                                    </div>
                                                    <div class="flex items-center justify-items-start">
                                                      <p class="text-sm leading-none text-black dark:text-gray-500 mr-3" id="beac_book">{{ $bookingData['beac_book'] }}</p>
                                                    </div>
                                                  </div>
                        
                                                  <div class="py-4 border-b border-gray-600 flex items-start justify-between">
                                                    <div class="flex items-center justify-items-start">
                                                        <p class="font-bold text-base leading-4 text-black dark:text-gray-500">ยอดรวม</p>
                                                    </div>
                                                    <div class="flex items-center justify-items-start">
                                                      <p class="text-sm leading-none text-black dark:text-gray-500 mr-3" id="total_amount">{{ $bookingData['total_amount'] }} บาท</p>
                                                    </div>
                                                  </div>                                                
                        
                        
                                                
                                            @error('booking_id')
                                                <span class=" text-red-600 my-2">{{$message}}</span>
                                            @enderror
                                            <div class="form-group mt-3 ">
                                                <label for="reason">เหตุผลในการขอคืนเงิน</label><br>
                                                <select class="form-control mt-1 bg-gray-50 border border-gray-900 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block py-24p-2.5 dark:bg-gray-700 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="reason" name="reason" required>
                                                    <option value="" disabled selected>เลือกเหตุผล</option>
                                                    <option value="cancel">ยกเลิกการจอง</option>
                                                    <option value="other">อื่นๆ</option>
                                                </select>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="additional_info">แจ้งรายละเอียดเพิ่มเติม</label>
                                                <br>
                                                <textarea class="mt-1 form-control block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2" id="additional_info" name="additional_info" rows="3" placeholder="ข้อความเพิ่มเติม"></textarea>
                                            </div>
                                            @if(session('success'))
                                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                                                {{session('success')}}
                                              </div>
                                            @endif
                                            <button type="submit" class="btn inline-block w-auto text-center px-3 py-2 text-white transition-all bg-gray-700 dark:bg-white dark:text-gray-800 rounded-md shadow-xl sm:w-auto hover:bg-gray-900 hover:text-white shadow-neutral-300 dark:shadow-neutral-700 hover:shadow-2xl hover:shadow-neutral-400 hover:-tranneutral-y-px">ยืนยัน</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-appu-layout>
