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
                <a class="nav-link" href="">Profile</a>
                <a class="nav-link" href="">Ubah Password</a>
            </nav>
            <hr class="mt-0 mb-4" />
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2" src="https://ui-avatars.com/api/?name=User" alt="" />
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG atau PNG tidak lebih besar dari 1 MB</div>
                            <!-- Profile picture upload button-->
                            <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="">
                                <input
                                  type="file"
                                  id="profile"
                                  name="profile"
                                  style="display: none;"
                                />    
                                <button class="btn btn-primary btn-sm" type="button" onclick="thisFileUpload();">
                                    <i data-feather="upload"></i> &nbsp; Unggah
                                </button>
                                <a href="" class="btn btn-danger btn-sm" id="profile-delete">
                                    <i data-feather="trash"></i> &nbsp; Hapus
                                </a>  
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Informasi Akun</div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label class="small mb-1" for="name">Nama</label>
                                    <input class="form-control" name="name" type="text" value="" required/>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" name="email" type="email" placeholder="name@example.com" value="" required/>
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


