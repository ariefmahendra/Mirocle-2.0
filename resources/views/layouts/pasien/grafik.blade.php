@extends('layouts.pasien.master')

@section('title')
    Grafik Realtime Pasien
@endsection

@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4 shadow">
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Detak Jantung</h6>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <canvas id="detakJantung"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4 shadow">
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Saturasi Oksigen</h6>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <canvas id="saturasiOksigen"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4 shadow">
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Jumlah Putaran Pedal</h6>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <canvas id="jumlahPutaranPedal"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4 shadow">
                        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
                            <h6 class="font-weight-bold text-primary m-0">Jumlah Kalori yang Terbakar</h6>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <canvas id="kalori"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
    </div>

    <<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var currentUser = {
            id: <?= Auth::guard()->user()->id ?>
        };

        // console.log("current id", currentUser.id)

        $(document).ready(function() {
            var detakJantung = [];
            var saturasiOksigen = [];
            var jumlahPutaranPedal = [];
            var kalori = [];
            var labels = [];
            var lastData = null;

            function updatechart() {
                $.ajax({
                    url: '/detakjantung/' + currentUser.id,
                    dataType: 'json',
                    success: function(data) {
                        if (JSON.stringify(data) === JSON.stringify(lastData)) {
                            return;
                        }

                        detakJantung = [];
                        saturasiOksigen = [];
                        jumlahPutaranPedal = [];
                        kalori = [];
                        labels = [];

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

                        lastData = data;

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
            setInterval(updatechart, 1000);
        });
    </script>
@endsection
