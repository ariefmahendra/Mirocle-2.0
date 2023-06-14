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
          
            <!-- Tombol Scroll ke Atas -->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
    </div>
@endsection