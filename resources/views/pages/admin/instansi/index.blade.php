@extends('layouts.admin')

@section('title')
    Data Instansi
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Instansi
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
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">Data Instansi</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="name">Nama Instansi</label>
                                    <input class="form-control" name="name" id="name" type="text"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="name">Alamat</label>
                                    <textarea name="" id="" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="lattitude">Lattitude</label>
                                    <input class="form-control" name="lattitude" type="text"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="longitude">Longitude</label>
                                    <input class="form-control" name="longitude" type="text"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="radius">Radius</label>
                                    <input class="form-control" name="radius" type="text"/>
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button class="btn btn-primary" type="submit">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">Map</div>
                        <div class="card-body">
                            <div id="map"></div>
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
        let mymap = L.map('map').setView([-6.200000, 106.816666], 13); 

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

        let marker = L.marker([-6.200000, 106.816666]).addTo(mymap)
            .bindPopup("<b>Halo!</b><br />Ini adalah Jakarta.").openPopup();
    </script>
@endpush





