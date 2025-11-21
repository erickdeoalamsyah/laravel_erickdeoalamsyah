@extends('layouts.app')

@section('content')
<h4 class="mb-3">{{ $title }}</h4>

<form action="{{ $route }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Nama Pasien</label>
        <input type="text" name="nama_pasien"
               class="form-control @error('nama_pasien') is-invalid @enderror"
               value="{{ old('nama_pasien', $pasien->nama_pasien) }}" required>
        @error('nama_pasien')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Rumah Sakit</label>
        <select name="rumah_sakit_id"
                class="form-select @error('rumah_sakit_id') is-invalid @enderror"
                required>
            <option value="">-- Pilih Rumah Sakit --</option>
            @foreach($rumahSakits as $rs)
                <option value="{{ $rs->id }}"
                        @selected(old('rumah_sakit_id', $pasien->rumah_sakit_id) == $rs->id)>
                    {{ $rs->nama_rumah_sakit }}
                </option>
            @endforeach
        </select>
        @error('rumah_sakit_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat"
               class="form-control"
               value="{{ old('alamat', $pasien->alamat) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">No Telepon</label>
        <input type="text" name="no_telpon"
               class="form-control"
               value="{{ old('no_telpon', $pasien->no_telpon) }}">
    </div>

    <button class="btn btn-success" type="submit">Simpan</button>
    <a href="{{ route('pasiens.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
