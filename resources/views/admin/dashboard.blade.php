@extends('layouts.admin')

@section('content')
<div class="pt-3 pb-2 mb-3 border-bottom">
    <h2>Dashboard Menu</h2>
</div>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card bg-dark text-white p-4 border-0 shadow-sm">
            <h5>Total Produk Aktif</h5>
            <h2 class="fw-bold">{{ $productCount }}</h2>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-success text-white p-4 border-0 shadow-sm">
            <h5>Total Foto Galeri</h5>
            <h2 class="fw-bold">{{ $galleryCount }}</h2>
        </div>
    </div>
</div>
@endsection