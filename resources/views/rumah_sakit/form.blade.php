@extends('layouts.app')

@section('content')
<h4 class="mb-3">{{ $title }}</h4>

<form action="{{ $route }}" method="POST">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Nama Rumah Sakit</label>
        <input type="text" name="nama_rumah_sakit"
               class="form-control @error('nama_rumah_sakit') is-invalid @enderror"
               value="{{ old('nama_rumah_sakit', $rumahSakit->nama_rumah_sakit) }}" required>
        @error('nama_rumah_sakit')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat"
               class="form-control"
               value="{{ old('alamat', $rumahSakit->alamat) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email"
               class="form-control"
               value="{{ old('email', $rumahSakit->email) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon"
               class="form-control"
               value="{{ old('telepon', $rumahSakit->telepon) }}">
    </div>

    <button class="btn btn-success" type="submit">Simpan</button>
    <a href="{{ route('rumah-sakit.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
