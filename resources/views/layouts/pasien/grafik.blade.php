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
                                <canvas id="saturasiOksigen"></canvas>
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
                                <canvas id="jumlahPutaranPedal"></canvas>
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

    <<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var detakJantung = [];
            var saturasiOksigen = [];
            var jumlahPutaranPedal = [];
            var kalori = [];
            var labels = [];
            var lastData = null;

            function updatechart() {
                $.ajax({
                    url: '/detakjantung/2',
                    dataType: 'json',
                    success: function(data) {
                        // Membandingkan data baru dengan data terakhir
                        if (JSON.stringify(data) === JSON.stringify(lastData)) {
                            return;
                        }

                        // Loop melalui setiap objek dalam data JSON
                        for (var i = 0; i < data.length; i++) {
                            var item = data[i];
                            detakJantung.push(item.detak_jantung);
                            saturasiOksigen.push(item.saturasi_oksigen);
                            jumlahPutaranPedal.push(item.putaran_pedal);
                            kalori.push(item.kalori);
                            var timestamp = item.timestamp;
                            var formattedTimestamp = timestamp.substr(11, 8);
                            labels.push(formattedTimestamp);
                        }

                        // Memperbarui data terakhir dengan data baru
                        lastData = data;

                        // Memperbarui grafik menggunakan data yang baru
                        var ctx = document.getElementById('detakJantung').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Detak Jantung',
                                    data: detakJantung,
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

                        // Memperbarui grafik menggunakan data yang baru
                        var ctx = document.getElementById('saturasiOksigen').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Saturasi Oksigen',
                                    data: saturasiOksigen,
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

                        // Memperbarui grafik menggunakan data yang baru
                        var ctx = document.getElementById('jumlahPutaranPedal').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Jumlah Putaran Pedal',
                                    data: jumlahPutaranPedal,
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

                        // Memperbarui grafik menggunakan data yang baru
                        var ctx = document.getElementById('kalori').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Kalori',
                                    data: kalori,
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
                    }
                })
            }
            // Mengambil dan memperbarui data grafik setiap 1 detik
            setInterval(updatechart, 1000);
        });
    </script>
@endsection
