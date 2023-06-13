@extends('layouts.fisioterapis.master')

@section('title')
    Input Pasien
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Tambahkan Pasien Button -->
        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <a class="btn btn-primary" href="{{ route('register') }}">
                    Tambahkan Pasien
                </a>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-bordered table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Device id</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $user->device_id }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->email }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('delete_user', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
