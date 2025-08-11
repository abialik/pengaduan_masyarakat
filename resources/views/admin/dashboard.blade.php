
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="#">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.petugas.index') }}">Manajemen Petugas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.pengaduan.index') }}">Data Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.laporan.index') }}">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard Admin</h1>
            </div>
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Pengaduan</h5>
                            <p class="card-text">{{ $total_pengaduan ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Proses</h5>
                            <p class="card-text">{{ $pengaduan_proses ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Selesai</h5>
                            <p class="card-text">{{ $pengaduan_selesai ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Petugas</h5>
                            <p class="card-text">{{ $total_petugas ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <h2>Pengaduan Terbaru</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>NIK</th>
                            <th>Isi Laporan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduan_terbaru ?? [] as $p)
                        <tr>
                            <td>{{ $p->tgl_pengaduan }}</td>
                            <td>{{ $p->nik }}</td>
                            <td>{{ Str::limit($p->isi_laporan, 50) }}</td>
                            <td>
                                @if($p->status == '0')
                                    <span class="badge badge-secondary">Belum Ditanggapi</span>
                                @elseif($p->status == 'proses')
                                    <span class="badge badge-warning">Proses</span>
                                @else
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.pengaduan.detail', $p->id_pengaduan) }}" class="btn btn-sm btn-primary">Detail</a>
                                @if($p->status == '0')
                                <a href="{{ route('admin.pengaduan.verifikasi', $p->id_pengaduan) }}" class="btn btn-sm btn-success">Verifikasi</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Tidak ada pengaduan terbaru.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@endsection