@extends('layouts.pasien.master')

@section('title')
    Grafik Realtime Pasien
@endsection

@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Content Row -->
            <div class="row">
                <!-- Grafik Detak Jantung -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4 shadow">
                        <!-- Header Kartu - Dropdown -->
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Detak Jantung</h6>
                            <div class="dropdown no-arrow">
                                <!-- Tambahkan elemen dropdown jika diperlukan -->
                            </div>
                        </div>
                        <!-- Isi Kartu -->
                        <div class="card-body d-flex justify-content-center">
                            <div class="chart-area">
                                <canvas id="detakJantung"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Grafik Saturasi Oksigen -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4 shadow">
                        <!-- Header Kartu - Dropdown -->
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Saturasi Oksigen</h6>
                            <div class="dropdown no-arrow">
                                <!-- Tambahkan elemen dropdown jika diperlukan -->
                            </div>
                        </div>
                        <!-- Isi Kartu -->
                        <div class="card-body d-flex justify-content-center">
                            <div class="chart-area">
                                <canvas id="saturasi"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Grafik Jumlah Putaran Pedal -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4 shadow">
                        <!-- Header Kartu - Dropdown -->
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Jumlah Putaran Pedal</h6>
                            <div class="dropdown no-arrow">
                                <!-- Tambahkan elemen dropdown jika diperlukan -->
                            </div>
                        </div>
                        <!-- Isi Kartu -->
                        <div class="card-body d-flex justify-content-center">
                            <div class="chart-area">
                                <canvas id="pedal"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Grafik Jumlah Kalori yang Terbakar -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4 shadow">
                        <!-- Header Kartu - Dropdown -->
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Jumlah Kalori yang Terbakar</h6>
                            <div class="dropdown no-arrow">
                                <!-- Tambahkan elemen dropdown jika diperlukan -->
                            </div>
                        </div>
                        <!-- Isi Kartu -->
                        <div class="card-body d-flex justify-content-center">
                            <div class="chart-area">
                                <canvas id="kalori"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tombol Scroll ke Atas -->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
    </div>
@endsection
@section('jsekstra')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(function() {
                $.ajax({
                    url: '/detakjantung/2', // URL untuk meminta data
                    type: 'GET', // Metode HTTP
                    success: function(data) {
                        console.log(data);
                        updateChart(data);
                    },
                });
            }, 1000); // 1000ms = 1s
        });

        function updateChart(data) {
            var detakJantungChart = window.detakJantungChart;
            var saturasiChart = window.saturasiChart;
            var putaranPedalChart = window.putaranPedalChart;
            var kaloriChart = window.kaloriChart;
            // Menghapus data yang melebihi batas 5
            if (detakJantungChart.data.labels.length >= 5) {
                detakJantungChart.data.labels.shift();
                detakJantungChart.data.datasets[0].data.shift();
            }
            if (saturasiChart.data.labels.length >= 5) {
                saturasiChart.data.labels.shift();
                saturasiChart.data.datasets[0].data.shift();
            }
            if (putaranPedalChart.data.labels.length >= 5) {
                putaranPedalChart.data.labels.shift();
                putaranPedalChart.data.datasets[0].data.shift();
            }
            if (kaloriChart.data.labels.length >= 5) {
                kaloriChart.data.labels.shift();
                kaloriChart.data.datasets[0].data.shift();
            }
            var timestamp = new Date(data.timestamp); // Menggunakan data.timestamp langsung
            var jam = timestamp.getHours().toString().padStart(2, '0');
            var menit = timestamp.getMinutes().toString().padStart(2, '0');
            var detik = timestamp.getSeconds().toString().padStart(2, '0');
            var jam_menit_detik = jam + ':' + menit + ':' + detik;
            detakJantungChart.data.labels.push(jam_menit_detik);
            detakJantungChart.data.datasets[0].data.push(data.detak_jantung);
            detakJantungChart.update();
            saturasiChart.data.labels.push(jam_menit_detik);
            saturasiChart.data.datasets[0].data.push(data.saturasi_oksigen);
            saturasiChart.update();
            putaranPedalChart.data.labels.push(jam_menit_detik);
            putaranPedalChart.data.datasets[0].data.push(data.putaran_pedal);
            putaranPedalChart.update();
            kaloriChart.data.labels.push(jam_menit_detik);
            kaloriChart.data.datasets[0].data.push(data.kalori);
            kaloriChart.update();
        }
        var detakJantungData = {
            labels: [],
            datasets: [{
                label: 'Detak Jantung',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [],
            }]
        };
        var saturasiData = {
            labels: [],
            datasets: [{
                label: 'Saturasi Oksigen',
                backgroundColor: 'rgb(255, 206, 86)',
                borderColor: 'rgb(255, 206, 86)',
                data: [],
            }]
        };
        var putaranPedalData = {
            labels: [],
            datasets: [{
                label: 'Jumlah Putaran Pedal',
                backgroundColor: 'rgb(75, 192, 192)',
                borderColor: 'rgb(75, 192, 192)',
                data: [],
            }]
        };
        var kaloriData = {
            labels: [],
            datasets: [{
                label: 'Jumlah Kalori yang Terbakar',
                backgroundColor: 'rgb(153, 102, 255)',
                borderColor: 'rgb(153, 102, 255)',
                data: [],
            }]
        };
        var configDetakJantung = {
            type: 'line',
            data: detakJantungData,
            options: {}
        };
        var configSaturasi = {
            type: 'line',
            data: saturasiData,
            options: {}
        };
        var configPutaranPedal = {
            type: 'line',
            data: putaranPedalData,
            options: {}
        };
        var configKalori = {
            type: 'line',
            data: kaloriData,
            options: {}
        };
        var detakJantungChart = new Chart(
            document.getElementById('detakJantung'),
            configDetakJantung
        );
        var saturasiChart = new Chart(
            document.getElementById('saturasi'),
            configSaturasi
        );
        var putaranPedalChart = new Chart(
            document.getElementById('pedal'),
            configPutaranPedal
        );
        var kaloriChart = new Chart(
            document.getElementById('kalori'),
            configKalori
        );
    </script>
@endsection
