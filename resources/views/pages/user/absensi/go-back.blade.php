@extends('layouts.admin')

@section('title')
    Absensi
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="clock"></i></div>
                                Absensi Pulang
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Lokasi Anda</div>
                        <div class="card-body">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Absen Pulang</div>
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show hide-alert" role="alert">
                                    {{ session('success') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show hide-alert" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($cek_absensi > 0)
                                @if ($cek_pulang > 0)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-form" style="display: none;">
                                    Anda berada di luar radius yang ditentukan. Anda tidak bisa mengisi absensi.
                                </div>
                                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-form-success" style="display: none;">
                                    Anda berada di dalam radius yang ditentukan. Anda bisa mengisi absensi.
                                </div>
                                <div style="display: block" id="absensi">
                                    <form action="{{ route('absensi.update', $item->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="name">Nama</label>
                                                <input class="form-control" name="name" type="text" value="{{ Auth::user()->name }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="gender">Jenis Kelamin</label>
                                                <input class="form-control" name="gender" type="text" value="{{ Auth::user()->gender }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="jabatan">Jabatan</label>
                                                <input class="form-control" name="jabatan" type="text" value="{{ Auth::user()->position }}" readonly/>
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="latitude">Lattitude</label>
                                                <input class="form-control" name="latitude" id="latitude" type="text" readonly/>
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="longitude">Longitude</label>
                                                <input class="form-control" name="longitude" id="longitude" type="text" readonly/>
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="out_time">Jam Pulang</label>
                                                <input class="form-control" name="out_time" id="out_time" value="{{ date('H:i:s') }}" type="text" readonly/>
                                            </div>
                                        </div>
                                        <!-- Submit button-->
                                        <button class="btn btn-primary" type="submit">
                                            Simpan Absen
                                        </button>
                                    </form>
                                </div>
                                @else
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Anda sudah mengisi absen hari ini.
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            @else
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Anda belum mengisi absen masuk, silahkan isi absen masuk terlebih dahulu.
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('addon-style')
    <link href="{{ url('admin/css/loader.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.81.0/dist/L.Control.Locate.min.css" />
    <style>
        #map { height: 300px; }
    </style>
@endpush

@push('addon-script')
    <script src="{{ url('admin/js/loader.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.81.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script>
        let mymap = L.map('map').setView([{{ $instansi->latitude }}, {{ $instansi->longitude }}], {{ $instansi->radius }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

        let referencePoint = L.latLng([{{ $instansi->latitude }}, {{ $instansi->longitude }}]);
        let radius = {{ $instansi->radius }}; 

        L.circle(referencePoint, {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: radius
        }).addTo(mymap);

        let marker = L.marker([{{ $instansi->latitude }}, {{ $instansi->longitude }}]).addTo(mymap)
            .bindPopup("<b>SMA Informatika Ciamis</b>").openPopup();


        function onLocationFound(e) {
            let userLatLng = e.latlng;
            let userRadius = e.accuracy;
            let lat = e.latlng.lat;
            let lng = e.latlng.lng;
            let distance = userLatLng.distanceTo(referencePoint);

            if (distance <= radius) {
                document.getElementById('absensi').style.display = 'block';
                document.getElementById('alert-form').style.display = 'none';
                document.getElementById('alert-form-success').style.display = 'block';
            } else {
                document.getElementById('absensi').style.display = 'none';
                document.getElementById('alert-form').style.display = 'block';
                document.getElementById('alert-form-success').style.display = 'none';

            }

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            let userMarker = L.marker(e.latlng).addTo(mymap)
                .bindPopup("Anda berada dalam " + userRadius + " meter dari titik ini.").openPopup();

        }

        function onLocationError(e) {
            alert(e.message);
        }

        L.control.locate({
            setView: true,
            maxZoom: 16,
            enableHighAccuracy: true,
            showPopup: true,
            strings: {
                title: "Temukan lokasimu",
                popup: "Anda berada dalam jarak {distance} {unit} dari titik ini",
                metersUnit: "meter",
                feetUnit: "feet",
                outsideMapBoundsMsg: "Anda berada di luar batas peta"
            }
        }).addTo(mymap);

        mymap.on('locationfound', onLocationFound);
        mymap.on('locationerror', onLocationError);
        mymap.locate({
            setView: true, 
            maxZoom: 16, 
            enableHighAccuracy: true, 
            timeout: 10000, 
            maximumAge: 0 
        });
    </script> 
@endpush





