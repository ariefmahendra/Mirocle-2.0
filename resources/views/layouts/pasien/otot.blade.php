@extends('layouts.pasien.master')

@section('title')
    Grafik Otot Pasien
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
                                <canvas id="otot1"></canvas>
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
                                <canvas id="otot2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                var otot1 = []; // Array untuk menyimpan data grafik
                var otot2 = []; // Array untuk menyimpan data grafik
                var labels = []; // Array untuk menyimpan label waktu
                var lastData = null; // Variabel untuk menyimpan data terakhir

                function fetchData() {
                    $.ajax({
                        url: '/otot/2',
                        dataType: 'json',
                        success: function(data) {
                            // Membandingkan data baru dengan data terakhir
                            if (JSON.stringify(data) === JSON.stringify(lastData)) {
                                return;
                            }

                            // Menghapus data grafik yang ada sebelumnya
                            chartData = [];
                            labels = [];

                            // Loop melalui setiap objek dalam data JSON
                            for (var i = 0; i < data.length; i++) {
                                var item = data[i];
                                otot1.push(item.amplitudo_awal);
                                otot2.push(item.amplitudo_akhir);
                                var timestamp = item.timestamp;
                                var formattedTimestamp = timestamp.substr(11, 8);
                                labels.push(formattedTimestamp);
                            }

                            // Memperbarui data terakhir dengan data baru
                            lastData = data;

                            // Memperbarui grafik menggunakan data yang baru
                            var ctx = document.getElementById('otot1').getContext('2d');
                            var chart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Amplitudo Awal',
                                        data: otot1,
                                        backgroundColor: 'rgba(0, 123, 255, 0.5)',
                                        borderColor: 'rgba(0, 123, 255, 1)',
                                        borderWidth: 3,
                                        fill: false,
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        x: {
                                            type: 'time',
                                            time: {
                                                displayFormats: {
                                                    hour: 'HH:mm:ss'
                                                }
                                            }
                                        }
                                    }
                                }
                            });

                            var ctx = document.getElementById('otot2').getContext('2d');
                            var chart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Amplitudo Akhir',
                                        data: otot2,
                                        backgroundColor: 'rgba(255, 0, 0, 0.5)',
                                        borderColor: 'rgba(255, 0, 0, 1)',
                                        borderWidth: 3,
                                        fill: false,
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        x: {
                                            type: 'time',
                                            time: {
                                                displayFormats: {
                                                    hour: 'HH:mm:ss'
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        }
                    });
                }

                // Mengambil dan memperbarui data grafik setiap 1 detik
                setInterval(fetchData, 1000);
            });
        </script>
    @endsection
