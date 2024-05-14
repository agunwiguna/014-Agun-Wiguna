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
                            <form class="row g-3" action="#" method="post">
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
                                    <button type="submit" class="btn btn-primary mb-3">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </main>
@endsection



