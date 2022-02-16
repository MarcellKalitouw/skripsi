@extends('adminView.layout')

@section('content')
@if ($message = Session::get('success'))
    
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success - </strong> {!! $message !!}
    </div>
@endif
<div class="card-group">
    <div class="card border-right">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <div class="d-inline-flex align-items-center">
                        <h2 class="text-dark mb-1 font-weight-medium">236</h2>
                        <span
                            class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+18.33%</span>
                    </div>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pelanggan per bulan</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-right">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                            class="set-doller">$</sup>18,306</h2>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Pendapatan per bulan
                    </h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-right">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <div class="d-inline-flex align-items-center">
                        <h2 class="text-dark mb-1 font-weight-medium">1538</h2>
                        <span
                            class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">-18.33%</span>
                    </div>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Transaksi per bulan</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <h2 class="text-dark mb-1 font-weight-medium">864</h2>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Saldo</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- *************************************************************** -->
<!-- End First Cards -->
<!-- *************************************************************** -->
<!-- Start Top Leader Table -->
<!-- *************************************************************** -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="card-title">Profile <b class="font-weight-bold text-info"> "{{ session()->get('nama') }}" </b></h2>
                    <div class="ml-auto">
                        
                        <div class="menu-right" >
                            <a href="{{ route('pengusaha.edit-profil', $getUser->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                                Edit Profile
                            </a>   
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-8">
                        <div class="image-pengusaha">
                            <img style="width:100%; max-height:500px;object-fit:cover;object-position:top" src="{{'gambar_pengusaha/'.$getUser->gambar}}" alt="">
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="profile-pengusaha">
                            <div class="head-profile" >
                                <h3 class="">Data - {{session()->get('nama') }}</h3>
                                
                            </div>
                            {{-- <ul class="list-style-none">
                                <li><i class="ti-angle-right"></i> Nama Laundry :</li>
                                <li><i class="ti-angle-right"></i> No Telepon   : </li>
                                <li><i class="ti-angle-right"></i> Email        : </li>
                                <li><i class="ti-angle-right"></i> Alamat        : </li>
                                <li><i class="ti-angle-right"></i> Deskripsi        : </li>
                            </ul> --}}
                            <dl>
                                <dt>Nama Laundry : </dt>
                                <dd>{{ $getUser->nama }}</dd>
                                <dt>Email :</dt>
                                <dd>{{ $getUser->email }}</dd>
                                <dt>Nomor Telepon :</dt>
                                <dd>{{ $getUser->no_telp }}</dd>
                                <dt>Alamat :</dt>
                                <dd>{{ $getUser->alamat }}</dd>
                                <dt>Deskripsi :</dt>
                                <dd>{{ $getUser->deskripsi }}</dd>
                            </dl>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- *************************************************************** -->

@endsection
