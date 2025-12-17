@extends('layouts.dasher.app')

@section('title', 'Tambah Pesanan')

@section('content')
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-2">Tambah Pesanan</h1>
                <p class="text-muted mb-0">Buat pesanan baru dan tambahkan item produk</p>
            </div>
            <div>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary">
                    <i class="ti ti-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pesanan.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Warga <span class="text-danger">*</span></label>
                            <select name="warga_id" class="form-select @error('warga_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach($warga as $w)
                                    <option value="{{ $w->warga_id }}">{{ $w->nama }} ({{ $w->no_ktp }})</option>
                                @endforeach
                            </select>
                            @error('warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select">
                                @foreach(['baru','diproses','selesai','dibatalkan'] as $st)
                                    <option value="{{ $st }}">{{ ucfirst($st) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Alamat Kirim</label>
                            <textarea name="alamat_kirim" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Metode Bayar</label>
                                    <input type="text" name="metode_bayar" class="form-control" placeholder="Transfer / COD">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <h5 class="mb-3">Item Pesanan</h5>
                <div id="items">
                    <div class="row g-3 align-items-end mb-2 item-row">
                        <div class="col-md-5">
                            <label class="form-label text-muted small">Produk</label>
                            <select name="produk_id[]" class="form-select">
                                <option value="">-- Pilih Produk --</option>
                                @foreach($produk as $p)
                                    <option value="{{ $p->produk_id }}" data-price="{{ $p->harga }}">{{ $p->nama_produk }} (Rp {{ number_format($p->harga,0,',','.') }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-muted small">Qty</label>
                            <input type="number" name="qty[]" class="form-control" min="1" value="1">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted small">Harga Satuan</label>
                            <input type="number" name="harga_satuan[]" class="form-control" step="0.01">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-danger remove-row">
                                <i class="ti ti-trash me-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-primary" id="addRow">
                        <i class="ti ti-plus me-1"></i> Tambah Item
                    </button>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Simpan Pesanan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const items = document.getElementById('items');
    document.getElementById('addRow').addEventListener('click', function() {
        const row = items.querySelector('.item-row').cloneNode(true);
        row.querySelectorAll('input').forEach(i => i.value = i.name.includes('qty') ? 1 : '');
        row.querySelector('select').selectedIndex = 0;
        items.appendChild(row);
        bindRow(row);
    });
    items.querySelectorAll('.item-row').forEach(bindRow);

    function bindRow(row) {
        const select = row.querySelector('select[name="produk_id[]"]');
        const harga = row.querySelector('input[name="harga_satuan[]"]');
        select.addEventListener('change', function() {
            const price = select.options[select.selectedIndex]?.getAttribute('data-price');
            if (price) harga.value = price;
        });
        row.querySelector('.remove-row').addEventListener('click', function() {
            if (document.querySelectorAll('.item-row').length > 1) {
                row.remove();
            }
        });
    }
});
</script>
@endpush
