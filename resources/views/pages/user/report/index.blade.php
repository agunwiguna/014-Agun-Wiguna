@extends('layouts.admin')

@section('title')
    Laporan
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Laporan
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">
                            Laporan Absensi
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="{{ route('report-user.index') }}" method="GET">
                                @csrf
                                <div class="col-auto">
                                    <label for="date1" class="visually-hidden"></label>
                                    <input type="date" class="form-control" id="date1" name="date1" required>
                                </div>
                                <div class="col-auto">
                                    <label for="date2" class="visually-hidden"></label>
                                    <input type="date" class="form-control" id="date2" name="date2" required>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" name="search" class="btn btn-primary mb-3">Cari</button>
                                </div>
                            </form>

                            @if ($searchPerformed)
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align: middle;">No.</th>
                                                <th style="vertical-align: middle;">NIP</th>
                                                <th style="vertical-align: middle;">Nama</th>
                                                <th style="vertical-align: middle;">Jabatan</th>
                                                <th style="vertical-align: middle;">Tanggal</th>
                                                <th style="vertical-align: middle;">Keterangan</th>
                                                <th style="vertical-align: middle;">Jam Masuk/Input</th>
                                                <th style="vertical-align: middle;">Jam Pulang</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @forelse ($absensi as $row)
                                                <tr>
                                                    <td>{{ $no++; }}</td>
                                                    <td>{{ $row->user->nip ?? '-' }}</td>
                                                    <td>{{ $row->user->name ?? '-' }}</td>
                                                    <td>{{ $row->user->position ?? '-' }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($row->date)) }}</td>
                                                    <td>{{ $row->description }}</td>
                                                    <td>{{ $row->entry_time }}</td>
                                                    <td>{{ $row->out_time }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if (count($absensi) > 0)
                                <ul>
                                    <li>Total Hadir : {{ $jumlah_hadir }}</li>
                                    <li>Total Izin : {{ $jumlah_izin }}</li>
                                    <li>Total Sakit : {{ $jumlah_sakit }}</li>
                                </ul>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </main>
@endsection



