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
                            <form class="row g-3" action="{{ route('report.index') }}" method="GET">
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
                                <div class="mb-3 text-end">
                                    <a class="btn btn-sm btn-success" href="{{ route('export-data-absensi', [$date1, $date2]) }}">
                                        <i data-feather="download"></i>&nbsp; Download Excel
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align: middle;">No.</th>
                                                <th style="vertical-align: middle;">NIP</th>
                                                <th style="vertical-align: middle;">Nama</th>
                                                <th style="vertical-align: middle;">Jabatan</th>
                                                <th style="vertical-align: middle;">Tanggal Awal</th>
                                                <th style="vertical-align: middle;">Tanggal Akhir</th>
                                                <th style="vertical-align: middle;" class="text-center">Jumlah <br> Hadir</th>
                                                <th style="vertical-align: middle;" class="text-center">Jumlah <br> Izin</th>
                                                <th style="vertical-align: middle;" class="text-center">Jumlah <br> Sakit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>{{ $no++; }}</td>
                                                    <td>{{ $user->nip }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->position }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($date1)) }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($date2)) }}</td>
                                                    <td class="text-center">
                                                        @php
                                                            $attendance = App\Models\Absensi::where([
                                                                ['user_id','=', $user->id],
                                                                ['description','=', 'Hadir'],
                                                            ])->whereBetween('date', [$date1, $date2])->count();
                                                        @endphp
                                                        {{ $attendance }}
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $permission = App\Models\Absensi::where([
                                                                ['user_id','=', $user->id],
                                                                ['description','=', 'Izin'],
                                                            ])->whereBetween('date', [$date1, $date2])->count();
                                                        @endphp
                                                        {{ $permission }}
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $sick = App\Models\Absensi::where([
                                                                ['user_id','=', $user->id],
                                                                ['description','=', 'Sakit'],
                                                            ])->whereBetween('date', [$date1, $date2])->count();
                                                        @endphp
                                                        {{ $sick }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </main>
@endsection



