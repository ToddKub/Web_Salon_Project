<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
     <!-- FontAwesome -->
    <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome/js/all.js')}}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>success</title>
</head>
<body class="my-auto mx-auto bg-slate-700">
    <div class="bg-slate-700 h-screen">
        <div class="bg-white mx-28 my-16 pt-9 rounded-lg">
          <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-auto">
              <path fill="currentColor"
                  d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
              </path>
          </svg>
          <div class="text-center">
              <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center mt-5">การชำระเงินสำเร็จแล้ว!</h3>
              <p class="text-gray-600 my-2">ขอบคุณสำหรับการจองคิวเข้าใช้บริการ Ravi</p>
              <p><strong>รายละเอียดการจอง:</strong></p>
              <ul>
                  <li>ชื่อ: {{ $nameuser}}</li>
                  <li>บริการ: {{ $service }}</li>
                  <li>ช่าง: {{ $beauticianName }}</li>
                  <li>วันที่: {{ date('d-m-Y', strtotime($date)) }}</li>
                  <li>เวลา: {{ $time }}</li>
                  <li>ราคา: {{ $price}} บาท</li>
                  <p><strong>หมายเหตุ:</strong></p>
                  <ul>
                      <li>กรุณาติดต่อร้านกรณีเกิดข้อผิดพลาด</li>
                      <li>เบอร์โทรศัพท์ร้าน: [099 121 5689]</li>
                  </ul>
              </ul>
          
              <div class="py-10 text-center">
                  <a href="{{ route('queueinfo') }}" class="px-10 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3 rounded-3xl">
                    กลับหน้าหลัก 
                 </a>
              </div>
          </div>
      </div>
    </div>
</body>
</html>
    