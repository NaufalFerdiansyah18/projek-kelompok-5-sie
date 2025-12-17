<div class="form-group mb-3">
    <label for="umkm_id">UMKM</label>
    <select name="umkm_id" id="umkm_id"
            class="form-control @error('umkm_id') is-invalid @enderror">
        <option value="">-- Pilih UMKM --</option>
        @foreach($umkm as $u)
            <option value="{{ $u->umkm_id }}"
                {{ old('umkm_id', $produk->umkm_id ?? '') == $u->umkm_id ? 'selected' : '' }}>
                {{ $u->nama_usaha }}
            </option>
        @endforeach
    </select>
    @error('umkm_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="nama_produk">Nama Produk</label>
    <input type="text" name="nama_produk" id="nama_produk"
           class="form-control @error('nama_produk') is-invalid @enderror"
           value="{{ old('nama_produk', $produk->nama_produk ?? '') }}">
    @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="harga">Harga</label>
    <input type="number" name="harga" id="harga" step="0.01"
           class="form-control @error('harga') is-invalid @enderror"
           value="{{ old('harga', $produk->harga ?? '') }}">
    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="stok">Stok</label>
    <input type="number" name="stok" id="stok" min="0"
           class="form-control @error('stok') is-invalid @enderror"
           value="{{ old('stok', $produk->stok ?? '') }}">
    @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="status">Status</label>
    <select name="status" id="status"
            class="form-control @error('status') is-invalid @enderror">
        <option value="aktif" {{ old('status', $produk->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="nonaktif" {{ old('status', $produk->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
    </select>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" rows="4"
              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="form-group mb-3">
    <label for="foto">Foto Produk</label>
    <input type="file" name="foto" id="foto"
           class="form-control @error('foto') is-invalid @enderror">
    @if(isset($produk->foto) && $produk->foto)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $produk->foto) }}" alt="Foto Produk" width="120" class="img-thumbnail">
        </div>
    @endif
    @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
