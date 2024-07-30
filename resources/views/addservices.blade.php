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
                            <a class="nav-link text-body"href="/register">สมัครสมาชิก</a>
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
    <!--information-->
    <div class="album py-5">        
        <div class="container-fluid mb-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 py-5">
            <div class="col">
                <div class="card text-center shadow-sm">
                <img src="{{URL::asset('/img/a1.png')}}"class="card-img-top" alt="...">
                    <div class="absolute bottom-0 left-0 right-0 text-black p-2 rounded-b-lg text-center" style="width: 100%;">
                        <h2 class="text-decoration">Hair stroke premium</h2>
                        <p class="card-text">เเพทเทิร์นลายเส้นพริ้วหวาน ฟูเนียนสวยธรรมชาติ✨</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center shadow-sm">
                <img src="{{URL::asset('/img/a2.png')}}"class="card-img-top" alt="...">
                    <div class="absolute bottom-0 left-0 right-0 text-black p-2 rounded-b-lg text-center" style="width: 100%;">
                        <h2 class="text-decoration">Aquarell Lips</h2>
                        <p class="card-text">เทคนิคนี้ฝังเม็ดสีได้เนียนละเอียด สีฟู สวยเนียนเป็นธรรมชาติ✨</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center shadow-sm">
                <img src="{{URL::asset('/img/a3.png')}}"class="card-img-top" alt="...">
                    <div class="absolute bottom-0 left-0 right-0 text-black p-2 rounded-b-lg text-center" style="width: 100%;">
                        <h2 class="text-decoration">Sweet Wet look</h2>
                        <p class="card-text">ต่อขนตาสไตล์เกาหลี ได้ลุคสาวอ้อนๆ ขนตาฟุ้งๆมีเสน่ห์✨</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center shadow-sm">
                <img src="{{URL::asset('/img/a4.png')}}"class="card-img-top" alt="...">
                    <div class="absolute bottom-0 left-0 right-0 text-black p-2 rounded-b-lg text-center" style="width: 100%;">
                        <h2 class="text-decoration">korea eyeliner</h2>
                        <p class="card-text">เส้นอายไลเนอร์ธรรมชาติ ทำให้ดวงตาหวาน ละมุน✨</p>
                    </div>
                </div>
            </div>
      
        </div>
        </div>
    </div>

     <!--information-->
     <div class="album py-1">        
        <div class="container-fluid mb-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 py-5">
          <div class="col">
              <div class="card text-center shadow-sm">
              <img src="{{URL::asset('/img/a5.png')}}"class="card-img-top" alt="...">
                  <div class="absolute bottom-0 left-0 right-0 text-black p-2 rounded-b-lg text-center" style="width: 100%;">
                      <h2 class="text-decoration">Blythe Doll</h2>
                      <p class="card-text">ขนตาทรงตุ๊กตาบลายธ์ หวานละมุน ขนตานุ่มมาก เบาสบายตา✨</p>
                  </div>
              </div>
          </div>
          <div class="col">
              <div class="card text-center shadow-sm">
              <img src="{{URL::asset('/img/a6.png')}}"class="card-img-top" alt="...">
                  <div class="absolute bottom-0 left-0 right-0 text-black p-2 rounded-b-lg text-center" style="width: 100%;">
                      <h2 class="text-decoration">ทรงฟิลเตอร์ Barbie</h2>
                      <p class="card-text">ต่อทรงฟิลเตอร์ ฟิลใจ สลับสั้นยาว ทำให้ตาเฉี่ยว ตาหวาน✨</p>
                  </div>
              </div>
          </div>
          <div class="col">
              <div class="card text-center shadow-sm">
              <img src="{{URL::asset('/img/a7.png')}}"class="card-img-top" alt="...">
                  <div class="absolute bottom-0 left-0 right-0 text-black p-2 rounded-b-lg text-center" style="width: 100%;">
                      <h2 class="text-decoration">ANIME เทคนิคเวียดนาม</h2>
                      <p class="card-text">ขนตาพรีเมียม นุ่ม เบา สบายตา ออร่ามาก วิ้งฉ่ำ  ขึ้นกล้อง300%✨</p>
                  </div>
              </div>
          </div>
          <div class="col">
              <div class="card text-center shadow-sm">
              <img src="{{URL::asset('/img/a8.png')}}"class="card-img-top" alt="...">
                  <div class="absolute bottom-0 left-0 right-0 text-black p-2 rounded-b-lg text-center" style="width: 100%;">
                      <h2 class="text-decoration">Super Slim Eyeliner</h2>
                      <p class="card-text">ฝังสีอายไลเนอร์เกาหลี ทำให้ดวงตาหวาน ละมุน มีเสน่ห์✨</p>
                  </div>
              </div>
          </div>
    
        </div>
        </div>
      </div>
    
    </div> 
</html>