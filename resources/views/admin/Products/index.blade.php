@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Manajemen Produk</h4>
        <p class="text-muted mb-0">Kelola daftar produk briket yang ditampilkan ke pelanggan.</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
        <i class="fas fa-plus me-2"></i>Tambah Produk
    </button>
</div>

{{-- Alert Session --}}
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

{{-- Tabel Produk --}}
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-4" style="width: 50px;">#</th>
                        <th style="width: 100px;">Foto</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th class="text-center pe-4" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                    <tr>
                        <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                        <td>
                            @if($product->foto_produk)
                                <img src="{{ Storage::url($product->foto_produk) }}"
                                     alt="{{ $product->nama_produk }}"
                                     class="rounded"
                                     style="width: 65px; height: 55px; object-fit: cover;">
                            @else
                                <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                     style="width: 65px; height: 55px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $product->nama_produk }}</td>
                        <td>
                            <span class="text-muted" style="max-width: 300px; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $product->deskripsi }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-success-subtle text-success fs-6 fw-semibold">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="text-center pe-4">
                            <button type="button"
                                    class="btn btn-sm btn-outline-warning btn-edit-produk me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditProduk"
                                    data-id="{{ $product->id }}"
                                    data-nama="{{ $product->nama_produk }}"
                                    data-deskripsi="{{ $product->deskripsi }}"
                                    data-harga="{{ $product->harga }}"
                                    data-foto="{{ $product->foto_produk ? Storage::url($product->foto_produk) : '' }}"
                                    title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-sm btn-outline-danger btn-hapus-produk"
                                    data-id="{{ $product->id }}"
                                    data-nama="{{ $product->nama_produk }}"
                                    title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            {{-- Form Hapus tersembunyi --}}
                            <form id="form-hapus-{{ $product->id }}"
                                  action="{{ route('admin.products.destroy', $product->id) }}"
                                  method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-box-open fa-3x mb-3 d-block opacity-25"></i>
                            Belum ada produk. Klik <strong>Tambah Produk</strong> untuk memulai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- ===================== MODAL TAMBAH PRODUK ===================== --}}
<div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-labelledby="labelTambahProduk" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="labelTambahProduk">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Produk Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="nama_produk" class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_produk') is-invalid @enderror"
                                   id="nama_produk" name="nama_produk"
                                   placeholder="Contoh: Briket Kelapa Premium 5 Kg"
                                   value="{{ old('nama_produk') }}" required>
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi Produk <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi"
                                      rows="4"
                                      placeholder="Jelaskan keunggulan dan spesifikasi produk...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="harga" class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                       id="harga" name="harga"
                                       placeholder="50000"
                                       value="{{ old('harga') }}" min="0" required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="foto_produk" class="form-label fw-semibold">Foto Produk</label>
                            <input type="file" class="form-control @error('foto_produk') is-invalid @enderror"
                                   id="foto_produk" name="foto_produk"
                                   accept="image/jpeg,image/png,image/webp">
                            <div class="form-text">Format: JPG, PNG, WEBP. Maks. 2MB.</div>
                            @error('foto_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Preview foto --}}
                        <div class="col-12" id="preview-tambah-wrapper" style="display:none;">
                            <img id="preview-tambah" src="#" alt="Preview"
                                 class="img-thumbnail mt-1" style="max-height: 160px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ===================== MODAL EDIT PRODUK ===================== --}}
<div class="modal fade" id="modalEditProduk" tabindex="-1" aria-labelledby="labelEditProduk" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="form-edit-produk" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="labelEditProduk">
                        <i class="fas fa-edit me-2"></i>Edit Produk
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="edit_nama_produk" class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_nama_produk" name="nama_produk" required>
                        </div>
                        <div class="col-12">
                            <label for="edit_deskripsi" class="form-label fw-semibold">Deskripsi Produk</label>
                            <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="4"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_harga" class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="edit_harga" name="harga" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_foto_produk" class="form-label fw-semibold">Ganti Foto Produk</label>
                            <input type="file" class="form-control" id="edit_foto_produk" name="foto_produk"
                                   accept="image/jpeg,image/png,image/webp">
                            <div class="form-text">Kosongkan jika tidak ingin mengubah foto.</div>
                        </div>
                        <div class="col-12">
                            <p class="form-label fw-semibold mb-2">Foto Saat Ini:</p>
                            <div id="edit-foto-wrapper">
                                <img id="edit-preview-foto" src="#" alt="Foto Produk"
                                     class="img-thumbnail" style="max-height: 130px;">
                                <p id="edit-no-foto" class="text-muted fst-italic" style="display:none;">Tidak ada foto.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning text-dark fw-semibold">
                        <i class="fas fa-save me-1"></i>Perbarui Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---- Preview foto saat tambah ----
    document.getElementById('foto_produk').addEventListener('change', function () {
        const wrapper = document.getElementById('preview-tambah-wrapper');
        const preview = document.getElementById('preview-tambah');
        if (this.files && this.files[0]) {
            preview.src = URL.createObjectURL(this.files[0]);
            wrapper.style.display = 'block';
        } else {
            wrapper.style.display = 'none';
        }
    });

    // ---- Isi data Modal Edit ----
    document.querySelectorAll('.btn-edit-produk').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const id       = this.dataset.id;
            const nama     = this.dataset.nama;
            const deskripsi= this.dataset.deskripsi;
            const harga    = this.dataset.harga;
            const foto     = this.dataset.foto;

            document.getElementById('form-edit-produk').action =
                '{{ url("admin/products") }}/' + id;

            document.getElementById('edit_nama_produk').value = nama;
            document.getElementById('edit_deskripsi').value   = deskripsi;
            document.getElementById('edit_harga').value       = harga;

            const imgEl  = document.getElementById('edit-preview-foto');
            const noFoto = document.getElementById('edit-no-foto');
            if (foto) {
                imgEl.src = foto;
                imgEl.style.display = 'inline-block';
                noFoto.style.display = 'none';
            } else {
                imgEl.style.display = 'none';
                noFoto.style.display = 'block';
            }
        });
    });

    // ---- Preview foto edit ----
    document.getElementById('edit_foto_produk').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const imgEl = document.getElementById('edit-preview-foto');
            imgEl.src = URL.createObjectURL(this.files[0]);
            imgEl.style.display = 'inline-block';
            document.getElementById('edit-no-foto').style.display = 'none';
        }
    });

    // ---- Konfirmasi Hapus dengan SweetAlert2 ----
    document.querySelectorAll('.btn-hapus-produk').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const id   = this.dataset.id;
            const nama = this.dataset.nama;
            Swal.fire({
                title: 'Hapus Produk?',
                html: `Produk <strong>${nama}</strong> akan dihapus permanen beserta fotonya.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash-alt me-1"></i>Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                }
            });
        });
    });

    // ---- SweetAlert2 dari session flash ----
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

    // ---- Buka otomatis modal tambah jika ada validation error ----
    @if($errors->any() && old('_method') === null)
        var modal = new bootstrap.Modal(document.getElementById('modalTambahProduk'));
        modal.show();
    @endif
});
</script>
@endpush