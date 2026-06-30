@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Manajemen Galeri</h4>
        <p class="text-muted mb-0">Upload dan kelola foto-foto galeri usaha Anda.</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUploadFoto">
        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Foto
    </button>
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

{{-- Grid Galeri --}}
@if($galleries->isEmpty())
<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5">
        <i class="fas fa-images fa-4x text-muted opacity-25 mb-3"></i>
        <h5 class="text-muted">Galeri Masih Kosong</h5>
        <p class="text-muted mb-4">Belum ada foto yang diupload. Mulai tambahkan foto galeri usaha Anda.</p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUploadFoto">
            <i class="fas fa-plus me-2"></i>Upload Foto Pertama
        </button>
    </div>
</div>
@else
<div class="row g-3">
    @foreach($galleries as $gallery)
    <div class="col-6 col-md-4 col-lg-3" id="gallery-item-{{ $gallery->id }}">
        <div class="card border-0 shadow-sm h-100 overflow-hidden gallery-card">
            {{-- Foto --}}
            <div class="position-relative gallery-img-wrapper">
                <img src="{{ Storage::url($gallery->foto) }}"
                     alt="{{ $gallery->judul }}"
                     class="card-img-top gallery-img"
                     style="height: 180px; object-fit: cover; cursor: pointer;"
                     data-bs-toggle="modal"
                     data-bs-target="#modalLihatFoto"
                     data-src="{{ Storage::url($gallery->foto) }}"
                     data-judul="{{ $gallery->judul }}">
                {{-- Overlay hapus --}}
                <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                    <button type="button"
                            class="btn btn-danger btn-sm btn-hapus-galeri rounded-circle shadow"
                            data-id="{{ $gallery->id }}"
                            data-judul="{{ $gallery->judul }}"
                            style="width: 40px; height: 40px;"
                            title="Hapus Foto">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                {{-- Form hapus tersembunyi --}}
                <form id="form-hapus-galeri-{{ $gallery->id }}"
                      action="{{ route('admin.gallery.destroy', $gallery->id) }}"
                      method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
            <div class="card-body p-2 text-center">
                <p class="mb-0 small fw-semibold text-truncate" title="{{ $gallery->judul }}">
                    {{ $gallery->judul }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Info jumlah foto --}}
<div class="mt-3 text-muted small">
    <i class="fas fa-info-circle me-1"></i>
    Total <strong>{{ $galleries->count() }}</strong> foto ditampilkan di galeri.
</div>
@endif


{{-- ===================== MODAL UPLOAD FOTO ===================== --}}
<div class="modal fade" id="modalUploadFoto" tabindex="-1" aria-labelledby="labelUploadFoto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="labelUploadFoto">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Foto Galeri
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">Judul Foto <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('judul') is-invalid @enderror"
                               id="judul" name="judul"
                               placeholder="Contoh: Proses Produksi Briket"
                               value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-semibold">Pilih Foto <span class="text-danger">*</span></label>
                        <input type="file"
                               class="form-control @error('foto') is-invalid @enderror"
                               id="foto" name="foto"
                               accept="image/jpeg,image/png,image/webp"
                               required>
                        <div class="form-text">Format: JPG, PNG, WEBP. Maks. 2MB.</div>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Area preview drop --}}
                    <div id="upload-preview-area" class="border rounded-3 p-3 text-center bg-light d-none">
                        <img id="upload-preview-img" src="#" alt="Preview"
                             class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                    <div id="upload-placeholder" class="border rounded-3 p-4 text-center bg-light text-muted">
                        <i class="fas fa-image fa-2x mb-2 d-block opacity-50"></i>
                        <small>Preview foto akan muncul di sini</small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload me-1"></i>Upload Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ===================== MODAL LIHAT FOTO (Lightbox) ===================== --}}
<div class="modal fade" id="modalLihatFoto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow bg-dark text-white">
            <div class="modal-header border-secondary">
                <h6 class="modal-title" id="lightbox-judul"></h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-2 text-center">
                <img id="lightbox-img" src="#" alt="" class="img-fluid rounded"
                     style="max-height: 70vh; width: auto;">
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---- Preview upload ----
    document.getElementById('foto').addEventListener('change', function () {
        const previewArea  = document.getElementById('upload-preview-area');
        const previewImg   = document.getElementById('upload-preview-img');
        const placeholder  = document.getElementById('upload-placeholder');
        if (this.files && this.files[0]) {
            previewImg.src = URL.createObjectURL(this.files[0]);
            previewArea.classList.remove('d-none');
            placeholder.classList.add('d-none');
        } else {
            previewArea.classList.add('d-none');
            placeholder.classList.remove('d-none');
        }
    });

    // ---- Lightbox foto ----
    document.querySelectorAll('.gallery-img').forEach(function (img) {
        img.addEventListener('click', function () {
            document.getElementById('lightbox-img').src   = this.dataset.src;
            document.getElementById('lightbox-judul').textContent = this.dataset.judul;
        });
    });

    // ---- Konfirmasi hapus galeri ----
    document.querySelectorAll('.btn-hapus-galeri').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            const id    = this.dataset.id;
            const judul = this.dataset.judul;
            Swal.fire({
                title: 'Hapus Foto?',
                html: `Foto <strong>${judul}</strong> akan dihapus permanen dari galeri.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash-alt me-1"></i>Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-galeri-' + id).submit();
                }
            });
        });
    });

    // ---- Toast SweetAlert2 session ----
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
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
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif

    // ---- Buka modal upload jika ada error validasi ----
    @if($errors->any())
        var modal = new bootstrap.Modal(document.getElementById('modalUploadFoto'));
        modal.show();
    @endif
});
</script>

<style>
.gallery-card { transition: transform .2s ease, box-shadow .2s ease; }
.gallery-card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,0,0,.12) !important; }
.gallery-img-wrapper { overflow: hidden; }
.gallery-overlay {
    background: rgba(0,0,0,.45);
    opacity: 0;
    transition: opacity .25s ease;
}
.gallery-card:hover .gallery-overlay { opacity: 1; }
</style>
@endpush