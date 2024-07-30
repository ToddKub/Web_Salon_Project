<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Raviporn Beauty') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- FontAwesome -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/js/all.js') }}" rel="stylesheet">
    <!---Datepicker--->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script>
        window.embeddedChatbotConfig = {
            chatbotId: "XlJMByzUcMu6Vbmi5jE1J",
            domain: "www.chatbase.co"
        }
    </script>
    <script src="https://www.chatbase.co/embed.min.js" chatbotId="XlJMByzUcMu6Vbmi5jE1J" domain="www.chatbase.co" defer>
    </script>
    <script>
        function fetchEvents() {
            fetch('{{ route('calendar.events') }}')
                .then(response => response.json())
                .then(data => {
                    this.events = data;
                    renderCalendar();
                });
        }

        function renderCalendar() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'th',
                buttonText: {
                    today: "วันนี้"
                },
                initialView: 'dayGridMonth',
                events: this.events
            });
            calendar.render();
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        <div class="min-h-screen bg-white md:pl-64">
            <!-- Page Heading -->
            @include('sweetalert::alert')
            @if (isset($header))
                <header class="bg-white shadow " x-data="{ open: false }">
                    <div class="max-w-full py-6 text-center mx-auto px-auto sm:px-10 sm:text-center md:px-9 md:text-left lg:px-10 lg:text-left">
                        <a href="#" @click="open = true" @click.away="open = false"
                            class="absolute left-0 pl-2 pr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 stroke-blue-600" fill="currentColor"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
                            </svg>
                        </a>
                        @include('layouts.sidebar2')
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
