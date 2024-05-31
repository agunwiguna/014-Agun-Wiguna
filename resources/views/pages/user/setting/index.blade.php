@extends('layouts.admin')

@section('title')
    Pengaturan
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="settings"></i></div>
                                Pengaturan - Informasi Akun
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link {{ (request()->is('user/setting-user')) ? 'active ms-0' : '' }}" href="{{ route('setting-user.index') }}">Profile</a>
                <a class="nav-link {{ (request()->is('user/setting-user/change-password-user')) ? 'active ms-0' : '' }}" href="{{ route('change-password-user') }}">Ubah Password</a>
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            @if ($user->profile != NULL)
                                <img class="img-account-profile rounded-circle mb-2" src="{{ Storage::url($user->profile) }}" alt="" />
                            @else
                                <img class="img-account-profile rounded-circle mb-2" src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="" />
                            @endif
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG atau PNG tidak lebih besar dari 1 MB</div>
                            <!-- Profile picture upload button-->
                            <form action="{{ route('profile-upload-user') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                                <input
                                  type="file"
                                  id="profile"
                                  name="profile"
                                  style="display: none;"
                                  onchange="form.submit()"
                                />    
                                <button class="btn btn-primary btn-sm" type="button" onclick="thisFileUpload();">
                                    <i data-feather="upload"></i> &nbsp; Unggah
                                </button>
                                @if ($user->profile != NULL)
                                    <a href="{{ route('profile-delete', $user->id) }}" class="btn btn-danger btn-sm" id="profile-delete">
                                        <i data-feather="trash"></i> &nbsp; Hapus
                                    </a>  
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Informasi Akun</div>
                        <div class="card-body">
                            {{-- Alert --}}
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show hide-alert" role="alert">
                                    {{ session('success') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('setting-user.update', $user->id) }}" method="POST" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="small mb-1" for="nip">NIP</label>
                                    <input class="form-control" name="nip" type="text" value="{{ $user->nip }}" required/>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="name">Nama</label>
                                    <input class="form-control" name="name" type="text" value="{{ $user->name }}" required/>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="gender">Jenis Kelamin</label> <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="Laki-Laki" {{ ($user->gender == 'Laki-Laki')?'checked':'' }}>
                                        <label class="form-check-label" for="gender1">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="Perempuan" {{ ($user->gender == 'Perempuan')?'checked':'' }}>
                                        <label class="form-check-label" for="gender2">Perempuan</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="position">Jabatan</label>
                                    <input class="form-control" name="position" type="text" value="{{ $user->position }}" readonly/>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" name="email" type="email" placeholder="name@example.com" value="{{ $user->email }}" required/>
                                </div>
                                <button class="btn btn-primary" type="submit">Perbarui Profil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const thisFileUpload = () => {
            document.getElementById("profile").click();
        }

        $('#profile-delete').click(function(e) {
            e.preventDefault();
            const href = $(this).attr('href');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan dihapus secara permanen !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
        })

        window.setTimeout(() => {
            $(".hide-alert").fadeTo(500, 0).slideUp(300, () => {
                $(this).remove(); 
            });
        }, 4000);
    </script> 
@endpush


