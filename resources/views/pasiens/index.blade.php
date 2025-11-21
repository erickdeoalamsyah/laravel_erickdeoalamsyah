@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Pasien</h4>
    <a href="{{ route('pasiens.create') }}" class="btn btn-success btn-sm">Tambah</a>
</div>

@if(session('success'))
    <div class="alert alert-success py-2">{{ session('success') }}</div>
@endif

<div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label">Filter Rumah Sakit (AJAX)</label>
        <select id="filter-rs" class="form-select">
            <option value="">Semua Rumah Sakit</option>
            @foreach($rumahSakits as $rs)
                <option value="{{ $rs->id }}">{{ $rs->nama_rumah_sakit }}</option>
            @endforeach
        </select>
    </div>
</div>

<table class="table table-bordered table-striped table-pasiens">
    <thead>
    <tr>
        <th>Nama Pasien</th>
        <th>Rumah Sakit</th>
        <th>Alamat</th>
        <th>No Telpon</th>
        <th width="150">Aksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pasiens as $pasien)
        <tr data-id="{{ $pasien->id }}">
            <td>{{ $pasien->nama_pasien }}</td>
            <td>{{ $pasien->rumahSakit->nama_rumah_sakit ?? '-' }}</td>
            <td>{{ $pasien->alamat }}</td>
            <td>{{ $pasien->no_telpon }}</td>
            <td>
                <a href="{{ route('pasiens.edit', $pasien) }}" class="btn btn-warning btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm btn-delete"
                        type="button"
                        data-id="{{ $pasien->id }}">
                    Hapus
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{-- paginate biasa (untuk initial load); filter ajax akan override rows --}}
{{ $pasiens->links() }}
@endsection

@push('scripts')
<script>
    // AJAX Delete
    $(document).on('click', '.btn-delete', function () {
        if (!confirm('Yakin hapus data pasien ini?')) return;

        const id  = $(this).data('id');
        const row = $('tr[data-id="' + id + '"]');

        $.ajax({
            url: '/pasiens/' + id,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                row.remove();
            },
            error: function () {
                alert('Gagal menghapus data.');
            }
        });
    });

    // AJAX Filter by Rumah Sakit
    $('#filter-rs').on('change', function () {
        const rsId = $(this).val();

        $.ajax({
            url: '{{ route('pasiens.filter') }}',
            type: 'GET',
            data: {
                rumah_sakit_id: rsId
            },
            success: function (data) {
                const tbody = $('.table-pasiens tbody');
                tbody.empty();

                if (data.length === 0) {
                    tbody.append(
                        '<tr><td colspan="5" class="text-center">Tidak ada data.</td></tr>'
                    );
                    return;
                }

                data.forEach(function (p) {
                    const rsName = p.rumah_sakit ? p.rumah_sakit.nama_rumah_sakit : '-';

                    const row = `
                        <tr data-id="${p.id}">
                            <td>${p.nama_pasien}</td>
                            <td>${rsName}</td>
                            <td>${p.alamat ?? ''}</td>
                            <td>${p.no_telpon ?? ''}</td>
                            <td>
                                <a href="/pasiens/${p.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm btn-delete"
                                        type="button"
                                        data-id="${p.id}">
                                    Hapus 
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.append(row);
                });
            },
            error: function () {
                alert('Gagal mengambil data.');
            }
        });
    });
</script>
@endpush
