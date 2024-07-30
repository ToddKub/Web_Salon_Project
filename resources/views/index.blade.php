<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Beauty_web</title>
</head>

<body class="bg-white">
    <div class="antialiased bg-white">
        <!--Navbar-->
        <div class="container-fluid"style="background-color: #FFFFFF;">
            <header
                class=" d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 border-bottom border-black border-3 fixed-top"
                style="background-color: #FFFFFF;">
                <div class="col-md-3 mb-2 mb-md-0">
                    <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                        <img src="{{ URL::asset('/img/icon.svg') }}"alt="alt text" width="80" height="60">
                    </a>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFFFFF;">
                    <span class= "boder boder-bottom boder-black">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="nav nav-underline me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link text-body" href="{{ route('login') }}">เข้าสู่ระบบ</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-body" href="{{ route('register') }}">สมัครสมาชิก</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-body" href="{{route('calendar')}}">ตารางการจองคิว</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-body" href="/addservices">บริการต่าง</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </span>
                </nav>
            </header>
            <!-- Separator Block -->
            <div class="my-5 bg-dark" style="height: 10px;"></div>
            <!--Hero-->
            <div class="container-fuild border-bottom ">
                <div class="px-10 py-10 my-10 text-center ">
                    <h1 class="display-4 fw-bold text-body-emphasis">ร้านเสริมสวยรวิพรความงาม</h1>
                    <h2 class="display-6 fw-semibold text-body-emphasis">Raviporn Beauties</h2>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner rounded-3 py-3 px-5">
                            <div class="carousel-item active">
                                <img src="{{ URL::asset('/img/n2.png') }}" class="d-block w-100" alt="..."
                                    height="500">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ URL::asset('/img/r-11.png') }}" class="d-block w-100" alt="..."
                                    height="500">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ URL::asset('/img/n1.png') }}" class="d-block w-100" alt="..."
                                    height="500">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!--   <div class="row align-items-center">
                    <div class="col mx-2">
                        <img src="{{ URL::asset('/img/n2.png') }}" alt="Example image"
                            class="img-fluid border rounded-3 shadow-lg my-4 " width="400" height="300"
                            loading="lazy">
                    </div>
                    <div class="col mx-2">
                        <img src="{{ URL::asset('/img/r-11.png') }}" alt="Example image"
                            class="img-fluid border rounded-3 shadow-lg my-4 " width="400" height="300"
                            loading="lazy">
                    </div>
                    <div class="col mx-2">
                        <img src="{{ URL::asset('/img/n1.png') }}"class="img-fluid border rounded-3 shadow-lg my-4"
                            alt="Example image" width="400" height="300" loading="lazy">
                    </div>
                </div>--->

                </div>
                <div class="col-lg-6 pb-3 mx-auto">
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-1">
                        <a href="{{ route('login') }}" style="text-decoration: none;">
                            <button type="button" class="btn bg-black btn-lg px-4 me-sm-3 text-white">จองคิว</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Separator Block -->
        <div class="my-10 bg-dark" style="height: 10px;"></div>
        <!--speartor Block-->
        <!--information-->
        <div class="album py-5">
            <div class= "container-fluid mb-4  text-center">
                <h2 class="text-decoration">บริการของเรา</h2>
            </div>
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                    <div class="col">
                        <div class="card text-center shadow-sm">
                            <img src="{{ URL::asset('/img/s1.png') }}"class="card-img-top" alt="...">
                            <div class="card-body">
                                <a class="card-text" href="/service">บริการต่อขนตา</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm">
                            <img src="{{ URL::asset('/img/s2.png') }}"class="card-img-top" alt="...">
                            <div class="card-body">
                                <a class="card-text" href="/service1">บริการสักคิ้ว</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm">
                            <img src="{{ URL::asset('/img/s3.png') }}"class="card-img-top" alt="...">
                            <div class="card-body">
                                <a class="card-text"href="/service2">บริการฝังอายไลน์เนอร์</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-center shadow-sm">
                            <img src="{{ URL::asset('/img/s4.png') }}"class="card-img-top" alt="...">
                            <div class="card-body">
                                <a class="card-text" href="/service3">บริการฝังสีปาก</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--ช่าง-->
        <div class="container">
            <div class= "container-fluid mb-4 text-center">
                <h2 class="mbr-title mbr-fonts-style mb-5 display-7">
                    <u>ช่างของเรา</u>
                </h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 text-center right col-lg-4">
                    <div class="wrap mb-4">
                        <img src="{{ URL::asset('/img/m-1.png') }}" class="img-thumbnail" alt="">
                    </div>
                    <h3 class="mbr-section-title mbr-fonts-stylemb-0 mb-4 font display-7">ช่างตูมตาม</h3>
                </div>
                <div class="col-12 col-md-6 mt-5 mt-md-0 text-center right col-lg-4">
                    <div class="wrap mb-4">
                        <img src="{{ URL::asset('/img/m-2.png') }}" class="img-thumbnail"style="height: 340px;"
                            alt="">
                    </div>
                    <h3 class="mbr-section-title mbr-fonts-style mb-4 font display-7">ช่างกี่</h3>
                </div>
            </div>
        </div>
        <!-- Separator Block -->
        <div class="my-10 bg-dark" style="height: 10px;"></div>
        <!-- Reviews -->

        <!-- Footer -->
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3">

                <ul class="nav col-md-4 justify-content-start list-unstyled d-flex">
                    <li class="ms-3"><a class="text-body-secondary" href="#"><svg
                                xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                viewBox="0 0 48 48">
                                <path fill="#00c300"
                                    d="M12.5,42h23c3.59,0,6.5-2.91,6.5-6.5v-23C42,8.91,39.09,6,35.5,6h-23C8.91,6,6,8.91,6,12.5v23C6,39.09,8.91,42,12.5,42z">
                                </path>
                                <path fill="#fff"
                                    d="M37.113,22.417c0-5.865-5.88-10.637-13.107-10.637s-13.108,4.772-13.108,10.637c0,5.258,4.663,9.662,10.962,10.495c0.427,0.092,1.008,0.282,1.155,0.646c0.132,0.331,0.086,0.85,0.042,1.185c0,0-0.153,0.925-0.187,1.122c-0.057,0.331-0.263,1.296,1.135,0.707c1.399-0.589,7.548-4.445,10.298-7.611h-0.001C36.203,26.879,37.113,24.764,37.113,22.417z M18.875,25.907h-2.604c-0.379,0-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687c0.379,0,0.687,0.308,0.687,0.687v4.521h1.917c0.379,0,0.687,0.308,0.687,0.687C19.562,25.598,19.254,25.907,18.875,25.907z M21.568,25.219c0,0.379-0.308,0.688-0.687,0.688s-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687s0.687,0.308,0.687,0.687V25.219z M27.838,25.219c0,0.297-0.188,0.559-0.47,0.652c-0.071,0.024-0.145,0.036-0.218,0.036c-0.215,0-0.42-0.103-0.549-0.275l-2.669-3.635v3.222c0,0.379-0.308,0.688-0.688,0.688c-0.379,0-0.688-0.308-0.688-0.688V20.01c0-0.296,0.189-0.558,0.47-0.652c0.071-0.024,0.144-0.035,0.218-0.035c0.214,0,0.42,0.103,0.549,0.275l2.67,3.635V20.01c0-0.379,0.309-0.687,0.688-0.687c0.379,0,0.687,0.308,0.687,0.687V25.219z M32.052,21.927c0.379,0,0.688,0.308,0.688,0.688c0,0.379-0.308,0.687-0.688,0.687h-1.917v1.23h1.917c0.379,0,0.688,0.308,0.688,0.687c0,0.379-0.309,0.688-0.688,0.688h-2.604c-0.378,0-0.687-0.308-0.687-0.688v-2.603c0-0.001,0-0.001,0-0.001c0,0,0-0.001,0-0.001v-2.601c0-0.001,0-0.001,0-0.002c0-0.379,0.308-0.687,0.687-0.687h2.604c0.379,0,0.688,0.308,0.688,0.687s-0.308,0.687-0.688,0.687h-1.917v1.23H32.052z">
                                </path>
                            </svg></a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">0991215689</a>
                    </li>
                    <li class="ms-3"><a class="text-body-secondary" href="#"><svg
                                xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                viewBox="0 0 48 48">
                                <path fill="#039be5" d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"></path>
                                <path fill="#fff"
                                    d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z">
                                </path>
                            </svg></a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Raviporn
                            Beauties</a></li>
                </ul>

                <a href="/"
                    class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.2" viewBox="0 0 250 250" width="200"
                        height="200">
                        <title>icon</title>
                        <defs>
                            <image width="134" height="134" id="img1"
                                href="data:image/png;base64,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" />
                        </defs>
                        <style>
                        </style>
                        <use id="Background" href="#img1" x="58" y="58" />
                    </svg>
                </a>

                <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">รวิพรความงาม 533
                            ถ.เทพคุณากร,
                        </a></li>
                    <li class="nav-item"><a href="#"
                            class="nav-link px-2 text-body-secondary">Chachoengsao,Thailand, Chachoengsao</a></li>
                </ul>
            </footer>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
            </script>
        </div>
    </div>
</body>
</html>
<!---<script>
var botmanWidget = {
        frameEndpoint:'/chatbot',
        displayMessageTime:false,
        title:'Ravi-bot',
        introMessage:'สวัสดีครับ สามารถสอบถามได้น่ะครับ',
        mainColor:'#999999',
        bubbleBackground:'#999999',
    };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
---->
<script>
    window.embeddedChatbotConfig = {
    chatbotId: "XlJMByzUcMu6Vbmi5jE1J",
    domain: "www.chatbase.co"
    }
</script>
<script
    src="https://www.chatbase.co/embed.min.js"
    chatbotId="XlJMByzUcMu6Vbmi5jE1J"
    domain="www.chatbase.co"
    defer>
</script>




