@extends('layouts.admin')

@section('title', 'Pengaturan Profil Usaha')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Profil Usaha</h4>
    <p class="text-muted mb-0">Kelola informasi utama tentang usaha briket Anda yang tampil di halaman utama.</p>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">

        {{-- Kolom Kiri: Foto & Identitas --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h6 class="fw-bold text-uppercase text-muted small mb-0">
                        <i class="fas fa-store me-2"></i>Foto & Identitas Usaha
                    </h6>
                </div>
                <div class="card-body d-flex flex-column align-items-center text-center pt-3">

                    {{-- Foto usaha --}}
                    <div class="position-relative mb-3">
                        <img id="preview-foto-usaha"
                             src="{{ $profile && $profile->foto_usaha ? Storage::url($profile->foto_usaha) : 'https://via.placeholder.com/200x200?text=Foto+Usaha' }}"
                             alt="Foto Usaha"
                             class="rounded-3 shadow"
                             style="width: 190px; height: 190px; object-fit: cover;">
                        <label for="foto_usaha"
                               class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle shadow"
                               style="width: 38px; height: 38px; padding: 0; line-height: 38px; cursor: pointer;"
                               title="Ganti Foto">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" id="foto_usaha" name="foto_usaha"
                               class="d-none @error('foto_usaha') is-invalid @enderror"
                               accept="image/jpeg,image/png,image/webp">
                    </div>
                    @error('foto_usaha')
                        <div class="text-danger small mb-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                    <p class="text-muted small mb-4">Klik ikon kamera untuk mengganti foto.<br>Format: JPG, PNG, WEBP. Maks. 2MB.</p>

                    {{-- Nama Usaha --}}
                    <div class="w-100 text-start">
                        <label for="nama_usaha" class="form-label fw-semibold">Nama Usaha <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('nama_usaha') is-invalid @enderror"
                               id="nama_usaha" name="nama_usaha"
                               placeholder="Contoh: Briket Nogosari"
                               value="{{ old('nama_usaha', $profile->nama_usaha ?? '') }}"
                               required>
                        @error('nama_usaha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Deskripsi, Visi, Misi --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h6 class="fw-bold text-uppercase text-muted small mb-0">
                        <i class="fas fa-align-left me-2"></i>Deskripsi & Nilai Usaha
                    </h6>
                </div>
                <div class="card-body pt-3">
                    <div class="mb-4">
                        <label for="deskripsi_usaha" class="form-label fw-semibold">Deskripsi Usaha <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi_usaha') is-invalid @enderror"
                                  id="deskripsi_usaha" name="deskripsi_usaha"
                                  rows="4"
                                  placeholder="Ceritakan secara singkat tentang usaha briket Anda, sejarah, dan keunggulannya...">{{ old('deskripsi_usaha', $profile->deskripsi_usaha ?? '') }}</textarea>
                        <div class="form-text">Tampil di bagian "Tentang Kami" pada halaman utama.</div>
                        @error('deskripsi_usaha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="visi" class="form-label fw-semibold">
                                <i class="fas fa-eye text-primary me-1"></i>Visi
                            </label>
                            <textarea class="form-control @error('visi') is-invalid @enderror"
                                      id="visi" name="visi"
                                      rows="5"
                                      placeholder="Tuliskan visi jangka panjang usaha Anda...">{{ old('visi', $profile->visi ?? '') }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="misi" class="form-label fw-semibold">
                                <i class="fas fa-bullseye text-danger me-1"></i>Misi
                            </label>
                            <textarea class="form-control @error('misi') is-invalid @enderror"
                                      id="misi" name="misi"
                                      rows="5"
                                      placeholder="Tuliskan misi-misi usaha Anda (bisa dipisah dengan baris baru)...">{{ old('misi', $profile->misi ?? '') }}</textarea>
                            <div class="form-text">Pisahkan tiap poin misi dengan baris baru.</div>
                            @error('misi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </div>

    </div>
</form>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---- Preview foto usaha ----
    document.getElementById('foto_usaha').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview-foto-usaha').src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // ---- Toast SweetAlert2 session ----
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Tersimpan!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal Menyimpan!',
            text: '{{ session('error') }}',
            timer: 3500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif
});
</script>
@endpush