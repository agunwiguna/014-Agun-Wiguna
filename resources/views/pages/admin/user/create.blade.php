@extends('layouts.admin')

@section('title')
    Tambah User
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="users"></i></div>
                                Tambah User
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('user.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Kembali ke Semua Data
                            </a>
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
                        <div class="card-header">Tambah Pengguna Baru</div>
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show col-8" role="alert">
                                    {{ session('success') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show col-8" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="nip">NIP</label>
                                        <input class="form-control @error('nip') is-invalid @enderror" name="nip" type="text" value="{{ old('nip') }}" placeholder="Masukan NIP.."/>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message; }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="name">Nama</label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}" placeholder="Masukan Nama.." required/>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message; }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="gender">Jenis Kelamin</label> <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="Laki-Laki">
                                            <label class="form-check-label" for="gender1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="Perempuan">
                                            <label class="form-check-label" for="gender2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="address">Alamat</label>
                                        <textarea name="address" id="address" class="form-control" placeholder="Masukan Alamat.." required></textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message; }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="position">Jabatan</label>
                                        <input class="form-control @error('position') is-invalid @enderror" name="position" type="text" value="{{ old('position') }}" placeholder="Masukan Jabatan.." required/>
                                        @error('position')
                                            <div class="invalid-feedback">
                                                {{ $message; }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="email">E-Mail</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email" type="text" value="{{ old('email') }}" placeholder="Masukan E-Mail.." required/>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message; }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Form Group (Password)-->
                                <div class="mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="password">Password</label>
                                        <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Masukan Password.."  required/>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message; }}
                                            </div>
                                        @enderror
                                    </div>   
                                </div>
                                <div class="mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="confirm_password">Ulangi Password</label>
                                        <input class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" type="password" placeholder="Ulangi Password.."  required/>
                                        @error('confirm_password')
                                            <div class="invalid-feedback">
                                                {{ $message; }}
                                            </div>
                                        @enderror
                                    </div>   
                                </div>
                                <div class="mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1">Role</label>
                                        <select class="form-select selectx @error('role_id') is-invalid @enderror" name="role_id" id="role_id" required>
                                            <option selected disabled>Select a role:</option>
                                            <option value="1" {{ (old('role_id') == '1')?'selected':'' }}>Admin</option>
                                            <option value="2" {{ (old('role_id') == '2')?'selected':'' }}>User</option>
                                        </select>
                                        @error('role_id')
                                            <div class="invalid-feedback">
                                                {{ $message; }}
                                            </div>
                                        @enderror
                                    </div> 
                                </div>
                                <!-- Submit button-->
                                <button class="btn btn-primary" type="submit">
                                    Tambah Pengguna Baru
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


