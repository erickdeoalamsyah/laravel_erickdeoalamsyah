@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Rumah Sakit</h4>
    <a href="{{ route('rumah-sakit.create') }}" class="btn btn-success btn-sm">Tambah</a>
</div>

@if(session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>Telepon</th>
        <th width="120">Aksi</th>
    </tr>
    </thead>
    <tbody>
    @forelse($rumahSakits as $rs)
        <tr>
            <td>{{ $rs->nama_rumah_sakit }}</td>
            <td>{{ $rs->alamat }}</td>
            <td>{{ $rs->email }}</td>
            <td>{{ $rs->telepon }}</td>
            <td>
                <a href="{{ route('rumah-sakit.edit', $rs) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('rumah-sakit.destroy', $rs) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
    @endforelse
    </tbody>
</table>

{{ $rumahSakits->links() }}
@endsection
