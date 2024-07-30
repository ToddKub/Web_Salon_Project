<x-app-layout>
    <x-slot name="header">
        admin dashboard
    </x-slot>
    <div class="grid grid-cols-2 gap-2 mx-3 my-3">
        <div class="p-9 bg-white drop-shadow-lg rounded-lg ">
            <h2>จำนวนสมัครสมาชิกบริการต่อเดือน</h2>
            <canvas id="userChart" style="width: 100%; height: 400px;"></canvas>
        </div>
        <div class="p-9  bg-white drop-shadow-lg rounded-lg ">
            <h2>จำนวนบริการ</h2>
            <canvas id="bookingChart"></canvas>
        </div>
        <div class="p-9  bg-white drop-shadow-lg rounded-lg ">
            <h2>ยอดจองคิวต่อเดือน</h2>
            <canvas id="bookingBarChart"></canvas>
        </div>
        <div class="p-9  bg-white drop-shadow-lg rounded-lg ">
            <h2>ยอดรวมเงินต่อเดือน</h2>
            <canvas id="totalPriceChart"></canvas>
        </div>
    </div>

    <script>
        //bar charts user
        const ctx = document.getElementById('userChart').getContext('2d');
        const userCounts = @json(array_values($userCounts));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthss) !!},
                datasets: [{
                    label: 'จำนวนผู้สมัครสมาชิก',
                    data: userCounts,
                    backgroundColor: 'rgba(122, 230, 0, 0.27)',
                    borderColor: 'rgba(152, 224, 70, 0.81)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0 // เพิ่มค่า precision เพื่อให้แสดงเป็นจำนวนเต็ม
                        }
                    }
                }
            }
        });

        // Booking services piechart
        const bookingCtx = document.getElementById('bookingChart').getContext('2d');
        const labels = @json($labels);
        const data = @json($data);

        new Chart(bookingCtx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'จำนวนบริการ',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.parsed;
                                var sum = context.dataset.data.reduce(function(a, b) {
                                    return a + b;
                                }, 0);
                                var percentage = (value / sum * 100).toFixed(2) + "%";
                                return label + ": " + percentage;
                            }
                        }
                    }
                },
            },
        });

        //bookingbarchart
        var barCtx = document.getElementById('bookingBarChart').getContext('2d');
        const bookingCounts = @json(array_values($bookingData));

        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthss) !!},
                datasets: [{
                    label: 'ยอดจองคิว',
                    data: bookingCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Total Price LineChart
        var totalPriceCtx = document.getElementById('totalPriceChart').getContext('2d');
        var totalPriceChart = new Chart(totalPriceCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labelss) !!},
                datasets: [{
                        label: 'ชำระเงินแล้ว',
                        data: {!! json_encode($paidData) !!},
                        backgroundColor: 'green',
                        borderColor: 'green',
                        fill: false
                    },
                    {
                        label: 'ยกเลิกการจอง',
                        data: {!! json_encode($cancelledData) !!},
                        backgroundColor: 'red',
                        borderColor: 'red',
                        fill: false
                    },
                    {
                        label: 'ขอคืนเงินเรียบร้อย',
                        data: {!! json_encode($refundedData) !!},
                        backgroundColor: 'orange',
                        borderColor: 'orange',
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
