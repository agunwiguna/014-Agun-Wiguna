@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('container')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="clock"></i></div>
                            Absensi
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="{{ route('presensi.index') }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali Ke Semua Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        @if ($item->description == 'Hadir')
        <div class="row gx-4">
            <div class="col-xl-12">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Lokasi</div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row gx-4">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <table class="table table-striped table-sm">
                            <tbody>
                                <tr>
                                    <td width="250">NIP</td>
                                    <td>: {{ $item->user->nip ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $item->user->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Absensi</td>
                                    <td>: {{ date('d-m-Y', strtotime($item->date)) }}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: {{ $item->description }}</td>
                                </tr>
                                <tr>
                                    <td>Jam Masuk/Input</td>
                                    <td>: {{ $item->entry_time }}</td>
                                </tr>
                                @if ($item->description == 'Izin' || $item->description == 'Sakit')
                                    <tr>
                                        <td>Catatan</td>
                                        <td>: {{ $item->notes }}</td>
                                    </tr>
                                @endif
                                @if ($item->description == 'Hadir')
                                <tr>
                                    <td>Jam Pulang</td>
                                    <td>: {{ $item->out_time }}</td>
                                </tr>
                                <tr>
                                    <td>Lattitude</td>
                                    <td>: {{ $item->latitude }}</td>
                                </tr>
                                <tr>
                                    <td>Longitude</td>
                                    <td>: {{ $item->longitude }}</td>
                                </tr>
                                @endif
                                @if ($item->picture != NULL)
                                    <tr>
                                        <td>Foto</td>
                                        <td>
                                            <a href="{{ Storage::url($item->picture) }}" target="_blank">
                                                <img src="{{ Storage::url($item->picture) }}" class="img-fluid rounded mb-2" alt="Foto" style="height: 165px;">
                                            </a>
                                        </td>
                                    </tr>  
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map { height: 300px; }
    </style>
@endpush

@push('addon-script')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var mymap = L.map('map', { zoomControl: true }).setView([{{ $item->latitude }}, {{ $item->longitude }}], 16);

        var circle = L.circle([{{ $instansi->latitude }}, {{ $instansi->longitude }}], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 50
        }).addTo(mymap);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

        L.marker([{{ $instansi->latitude }}, {{ $instansi->longitude }}]).addTo(mymap).bindPopup('Lokasi Instansi');
        L.marker([{{ $item->latitude }}, {{ $item->longitude }}]).addTo(mymap).bindPopup('Lokasi Karyawan').openPopup();

    </script>
@endpush