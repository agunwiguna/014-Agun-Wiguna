@extends('layouts.admin')

@section('title')
    Data User
@endsection

@section('container')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon">
                                    <i data-feather="users"></i>
                                </div>
                                Data User
                            </h1>
                            <div class="page-header-subtitle">List User</div>
                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <a class="btn btn-sm btn-primary" href="{{ route('user.create') }}">
                                Tambah User Baru
                            </a>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- List Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm" id="userTable">
                                    <thead>
                                        <tr>
                                            <th width="10" style="vertical-align: middle;" class="text-center">No.</th>
                                            <th style="vertical-align: middle;" class="text-left">NIP</th>
                                            <th style="vertical-align: middle;" class="text-left">Nama</th>
                                            <th style="vertical-align: middle;" class="text-left">JK</th>
                                            <th style="vertical-align: middle;" class="text-left">Jabatan</th>
                                            <th style="vertical-align: middle;" class="text-left">Role</th>
                                            <th style="vertical-align: middle;" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </main>
@endsection

@push('addon-script')
  <script>
    let datatable = $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
          url: '{!! url()->current() !!}',
        },
        columns: [
          {
            "data": 'DT_RowIndex',
            orderable: false, 
            searchable: false,
            "className": "text-center",
          },
          { data: 'nip', name: 'nip' },
          { data: 'name', name: 'name' },
          { data: 'gender', name: 'gender' },
          { data: 'position', name: 'position' },
          { data: 'role.name', name: 'role.name' },
          { 
            data: 'action', 
            name: 'action',
            orderable: false,
            searcable: false,
            width: '15%',
            "className": "text-center",
          },
        ]
    });
  </script>
@endpush

