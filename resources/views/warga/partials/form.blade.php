<div class="row">
    <div class="col-md-6 mb-3">
        <label for="no_ktp" class="form-label">No KTP</label>
        <input type="text"
               class="form-control @error('no_ktp') is-invalid @enderror"
               id="no_ktp"
               name="no_ktp"
               value="{{ old('no_ktp', $warga->no_ktp ?? '') }}"
               required>
        @error('no_ktp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text"
               class="form-control @error('nama') is-invalid @enderror"
               id="nama"
               name="nama"
               value="{{ old('nama', $warga->nama ?? '') }}"
               required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                id="jenis_kelamin"
                name="jenis_kelamin"
                required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="agama" class="form-label">Agama</label>
        <select class="form-select @error('agama') is-invalid @enderror"
                id="agama"
                name="agama"
                required>
            <option value="">-- Pilih Agama --</option>
            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                <option value="{{ $agama }}" {{ old('agama', $warga->agama ?? '') == $agama ? 'selected' : '' }}>
                    {{ $agama }}
                </option>
            @endforeach
        </select>
        @error('agama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="pekerjaan" class="form-label">Pekerjaan</label>
        <input type="text"
               class="form-control @error('pekerjaan') is-invalid @enderror"
               id="pekerjaan"
               name="pekerjaan"
               value="{{ old('pekerjaan', $warga->pekerjaan ?? '') }}">
        @error('pekerjaan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="telp" class="form-label">Telepon</label>
        <input type="text"
               class="form-control @error('telp') is-invalid @enderror"
               id="telp"
               name="telp"
               value="{{ old('telp', $warga->telp ?? '') }}">
        @error('telp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email"
               class="form-control @error('email') is-invalid @enderror"
               id="email"
               name="email"
               value="{{ old('email', $warga->email ?? '') }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
