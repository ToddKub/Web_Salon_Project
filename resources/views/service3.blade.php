!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Our Service</title>
    </head>
    <body>
        <div class="container-fluid "style="background-color: #F5EAE4;"> 
            <header class=" d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom border-black border-3 fixed-top" style="background-color: #F5EAE4;">
              <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="{{URL::asset('/img/icon.svg')}}"alt="alt text" width="80" height="60">
                </a>
              </div>
              <span class= "boder boder-bottom boder-black">
              <nav class="navbar navbar-expand-lg"style="background-color: #F5EAE4;">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <ul class="nav nav-underline">
                          <li class="nav-item">
                            <a class="nav-link text-body"href="#">สมัครสมาชิก</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-body" href="#">ตารางการจองคิว</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-body" href="#">การชำระเงิน</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-body" href="#">การคืนเงิน</a>                    </li>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-body" href="#">บริการต่าง</a>
                          </li>
                        </ul>
                     </div>
                 </div>
              </nav>
            </header>
            <!-- paragaph -->
            <div class="row featurette my-auto py-5">
                <div class="col-md-7 my-auto py-auto">
                  <h2 class="featurette-heading fw-normal lh-1">💋ฝังสีปาก แบบ Kiss Lips💋<span class="text-body-secondary">เทคนิคฝังสีปากเนียนละเอียด ขอบปากนุ่มฟุ้งไม่เน้นขอบปากดูละมุนเหมือนปากเด็ก</span></h2>
                  <p class="lead">▪︎ แก้ไขปัญหา ปากซีด ปากคล้ำ ผิวเม็ดต่อมไขมัน ปรับให้สีสวยเนียนเป็นธรรมชาติ</p>
                  <p class="lead">▪ ผลิตภัณฑ์สีนำเข้าจากอเมริกาเเละเยอรมัน</p>
                  <p class="lead">▪︎ ผลิตภัณฑ์สี ออแกนิก สกัดจาธรรมชาติ100%</p>
                  <p class="badge text-bg-primary text-wrap fs-5" style="width: 15rem;">ราคา 6,900 บาท</p>
                </div>
                <div class="col-md-5 my-5 py-auto">
                  <img class=" featurette-image img-thumbnail mx-auto" 
                  width="500" height="500"src="{{URL::asset('/img/l1.png')}}" >
                </div>
              </div>

              <div class="row featurette my-auto pb-5">
                <div class="col-md-7 order-md-2">
                  <h2 class="featurette-heading fw-normal lh-1">💋ฝังสีปาก แบบ Super Flash Lips💋<span class="text-body-secondary">ฝังสีปากเม็ดสีชัดสวยตั้งเเต่ครั้งเเรก สีสวยอย่างเป็นธรรมชาติ</span></h2>
                  <p class="lead">▪︎ แก้ไขปัญหา ปากซีด ปากคล้ำ ผิวเม็ดต่อมไขมัน ปรับให้สีสวยเนียนเป็นธรรมชาติ</p>
                  <p class="lead">▪ ผลิตภัณฑ์สีนำเข้าจากอเมริกาเเละเยอรมัน</p>
                  <p class="lead">▪︎ ผลิตภัณฑ์สี ออแกนิก สกัดจาธรรมชาติ100%</p>
                  <p class="badge text-bg-primary text-wrap fs-5" style="width: 15rem;">ราคา 6,900 บาท</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img class="featurette-image img-thumbnail mx-auto" 
                    width="500" height="500"src="{{URL::asset('/img/l2.png')}}">
                </div>
              </div>

              <div class="row featurette my-auto py-5">
                <div class="col-md-7 my-auto py-auto">
                  <h2 class="featurette-heading fw-normal lh-1">💋ฝังสีปาก แบบ Aquarell Lips💋<span class="text-body-secondary">ฝังสีปากเทคนิคยุโรปเทคนิคที่ดีที่สุด เม็ดสีคุณภาพ สกัดจากธรรมชาติ</span></h2>
                  <p class="lead">▪︎ แก้ไขปัญหา ปากซีด ปากคล้ำ ผิวเม็ดต่อมไขมัน ปรับให้สีสวยเนียนเป็นธรรมชาติ</p>
                  <p class="lead">▪ ผลิตภัณฑ์สีนำเข้าจากอเมริกาเเละเยอรมัน</p>
                  <p class="lead">▪︎ ผลิตภัณฑ์สี ออแกนิก สกัดจาธรรมชาติ100%</p>
                  <p class="badge text-bg-primary text-wrap fs-5" style="width: 15rem;">ราคา 6,900 บาท</p>
                </div>
                <div class="col-md-5 my-5 py-auto">
                  <img class=" featurette-image img-thumbnail mx-auto" 
                  width="500" height="500"src="{{URL::asset('/img/l3.png')}}" >
                </div>
              </div>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>