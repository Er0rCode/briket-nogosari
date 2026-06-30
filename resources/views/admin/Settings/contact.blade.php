@extends('layouts.admin')

@section('title', 'Pengaturan Kontak')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Informasi Kontak</h4>
    <p class="text-muted mb-0">Kelola nomor WhatsApp, media sosial, alamat, dan lokasi peta usaha Anda.</p>
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

<form action="{{ route('admin.contact.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row g-4">

        {{-- Kolom Kiri: Detail Kontak --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h6 class="fw-bold text-uppercase text-muted small mb-0">
                        <i class="fas fa-address-book me-2"></i>Detail Kontak
                    </h6>
                </div>
                <div class="card-body pt-3">

                    {{-- WhatsApp --}}
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label fw-semibold">
                            <i class="fab fa-whatsapp text-success me-2"></i>Nomor WhatsApp
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-success text-white border-success">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <input type="text"
                                   class="form-control @error('whatsapp') is-invalid @enderror"
                                   id="whatsapp" name="whatsapp"
                                   placeholder="Contoh: 6281234567890"
                                   value="{{ old('whatsapp', $contact->whatsapp ?? '') }}">
                            @error('whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text">Format tanpa tanda + atau 0 di depan. Contoh: <code>628123456789</code></div>
                    </div>

                    {{-- Instagram --}}
                    <div class="mb-3">
                        <label for="instagram" class="form-label fw-semibold">
                            <i class="fab fa-instagram text-danger me-2"></i>Instagram
                        </label>
                        <div class="input-group">
                            <span class="input-group-text" style="background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); color:white; border: none;">
                                <i class="fab fa-instagram"></i>
                            </span>
                            <span class="input-group-text bg-light text-muted">@</span>
                            <input type="text"
                                   class="form-control @error('instagram') is-invalid @enderror"
                                   id="instagram" name="instagram"
                                   placeholder="username_instagram"
                                   value="{{ old('instagram', $contact->instagram ?? '') }}">
                            @error('instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text">Isi hanya username tanpa simbol @.</div>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="fas fa-envelope text-primary me-2"></i>Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white border-primary">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email"
                                   placeholder="email@usaha.com"
                                   value="{{ old('email', $contact->email ?? '') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">
                            <i class="fas fa-map-marker-alt text-danger me-2"></i>Alamat Lengkap
                        </label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                  id="alamat" name="alamat"
                                  rows="4"
                                  placeholder="Tulis alamat lengkap usaha Anda...">{{ old('alamat', $contact->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Preview Link Sosmed --}}
                    @if(($contact->whatsapp ?? false) || ($contact->instagram ?? false))
                    <div class="border rounded-3 p-3 bg-light">
                        <p class="small fw-semibold text-muted mb-2">Link Aktif:</p>
                        @if($contact->whatsapp ?? false)
                        <a href="https://wa.me/{{ $contact->whatsapp }}" target="_blank"
                           class="btn btn-sm btn-outline-success me-1 mb-1">
                            <i class="fab fa-whatsapp me-1"></i>Buka WhatsApp
                        </a>
                        @endif
                        @if($contact->instagram ?? false)
                        <a href="https://instagram.com/{{ $contact->instagram }}" target="_blank"
                           class="btn btn-sm btn-outline-danger mb-1">
                            <i class="fab fa-instagram me-1"></i>Buka Instagram
                        </a>
                        @endif
                    </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Google Maps --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h6 class="fw-bold text-uppercase text-muted small mb-0">
                        <i class="fas fa-map me-2"></i>Google Maps Embed
                    </h6>
                </div>
                <div class="card-body pt-3 d-flex flex-column">
                    <div class="mb-3">
                        <label for="google_maps" class="form-label fw-semibold">
                            Kode Embed Google Maps
                        </label>
                        <textarea class="form-control font-monospace @error('google_maps') is-invalid @enderror"
                                  id="google_maps" name="google_maps"
                                  rows="5"
                                  placeholder='&lt;iframe src="https://www.google.com/maps/embed?pb=..." ...&gt;&lt;/iframe&gt;'
                                  style="font-size: 0.8rem;">{{ old('google_maps', $contact->google_maps ?? '') }}</textarea>
                        @error('google_maps')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Cara mendapatkan kode embed:
                            <a href="https://maps.google.com" target="_blank" class="text-decoration-none">Buka Google Maps</a>
                            → Cari lokasi → Klik <strong>Bagikan</strong> → Tab <strong>Sematkan peta</strong> → Salin kode HTML.
                        </div>
                    </div>

                    {{-- Preview Maps --}}
                    <div class="flex-grow-1">
                        @if($contact && $contact->google_maps)
                        <p class="small fw-semibold text-muted mb-2">Preview Peta Saat Ini:</p>
                        <div class="ratio ratio-16x9 rounded overflow-hidden border" id="maps-preview-container">
                            {!! $contact->google_maps !!}
                        </div>
                        @else
                        <div class="border rounded-3 d-flex align-items-center justify-content-center bg-light text-muted flex-grow-1"
                             id="maps-preview-placeholder" style="min-height: 220px;">
                            <div class="text-center">
                                <i class="fas fa-map-marked-alt fa-3x mb-2 opacity-25"></i>
                                <p class="mb-0 small">Preview peta akan muncul<br>setelah kode embed diisi dan disimpan.</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

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

    // ---- Sanitasi iframe Google Maps sebelum preview live (opsional) ----
    // Kode embed hanya di-render sisi server setelah disimpan (lebih aman).
    // Jika ingin preview live, uncomment bagian ini dengan hati-hati:
    /*
    document.getElementById('google_maps').addEventListener('input', function () {
        // PERHATIAN: Hanya aktifkan jika Anda percaya pengguna admin.
        // Render langsung innerHTML bisa menimbulkan risiko XSS.
    });
    */
});
</script>
@endpush   