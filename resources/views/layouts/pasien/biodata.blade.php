@extends('layouts.pasien.master')

@section('title')
    Biodata Pasien
@endsection

@section('content')
    <!-- Content Wrapper -->
    <div class="container rounded bg-white">
        <div class="d-flex align-items-center flex-column mb-3">
            <div class="mt-3">
                @if (session('Success'))
                    <div class="alert alert-primary">
                        {{ session('Success') }}
                    </div>
                @endif
            </div>
            <div class="col-md-5 mt-3 mb-3 rounded border shadow-lg">
                <div class="d-flex flex-column align-items-center p-3 text-center">
                    <img class="rounded-circle" width="120px"
                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                </div>
                <div class="p-3">
                    <form method="POST" action="{{ route('pasien.update_profile') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="labels">Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama"
                                    value="{{ Auth::user()->name }}" disabled>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Umur</label>
                                <input type="number" name="umur" class="form-control" placeholder="Masukkan umur"
                                    value="" required>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Berat Badan</label>
                                <input type="number" name="berat_badan" class="form-control"
                                    placeholder="Masukkan berat badan" value="" required>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Riwayat Penyakit</label>
                                <input type="text" name="riwayat_penyakit" class="form-control"
                                    placeholder="Masukkan riwayat penyakit" value="" required>
                            </div>
                            <div class="col-md-12 mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
