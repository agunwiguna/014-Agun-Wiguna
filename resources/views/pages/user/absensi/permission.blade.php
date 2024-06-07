@extends('layouts.admin')

@section('title')
    Absensi Izin/Sakit
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
                                Absensi Izin/Sakit
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
                        <div class="card-header">Absen Izin/Sakit</div>
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
                            <div id="loading-overlay">
                                <div id="loader"></div>
                                <p id="loading-message">Sedang menyimpan data..</p>
                            </div>
                            @if ($cek_absensi == 0)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-form" style="display: none;">
                                Anda berada di luar radius yang ditentukan. Anda tidak bisa mengisi absensi.
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-form-success" style="display: none;">
                                Anda berada di dalam radius yang ditentukan. Anda bisa mengisi absensi.
                            </div>
                            <div style="display: block" id="absensi">
                                <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="nip">NIP</label>
                                            <input class="form-control" name="nip" type="text" value="{{ Auth::user()->nip }}" readonly/>
                                        </div>
                                    </div>
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
                                            <label class="small mb-1" for="description">Keterangan</label>
                                            <select name="description" id="description" class="form-control" required>
                                                <option value="">Pilih..</option>
                                                <option value="Izin">Izin</option>
                                                <option value="Sakit">Sakit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="description">Catatan</label>
                                            <textarea name="notes" id="notes" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="">Lampiran (Opsional) Surat Keterangan Sakit, Surat Tugas, dll.</label> <br>
                                            <input type="file" id="picture" name="picture" style="display: none;" accept="image/*" capture="environment"/> 
                                            <button class="btn btn-success" type="button" onclick="thisFileUpload();">
                                            <i data-feather="camera"></i> &nbsp; Ambil Foto
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for=""></label>
                                            <img id="preview-img" src="/admin/assets/img/empty-image.jpg" class="img-fluid rounded mb-2" alt="Preview Image" style="height: 165px;">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('addon-style')
    <link href="{{ url('admin/css/loader.css') }}" rel="stylesheet" />
@endpush

@push('addon-script')
    <script src="{{ url('admin/js/loader.js') }}"></script>
    <script>
        function thisFileUpload() {
            document.getElementById("picture").click();
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); 
            }
        }

        $("#picture").change(function() {
            readURL(this);
        });
    </script> 
@endpush





