<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * CRUD Pasien:
 * - delete via AJAX
 * - filter by rumah sakit via AJAX.
 */
class PasienController extends Controller
{
    public function index()
    {
        $rumahSakits = RumahSakit::orderBy('nama_rumah_sakit')->get();

        // initial load pakai paginate
        $pasiens = Pasien::with('rumahSakit')
            ->orderBy('nama_pasien')
            ->paginate(10);

        return view('pasiens.index', [
            'title'       => 'Data Pasien',
            'pasiens'     => $pasiens,
            'rumahSakits' => $rumahSakits,
        ]);
    }

    public function create()
    {
        $rumahSakits = RumahSakit::orderBy('nama_rumah_sakit')->get();

        return view('pasiens.form', [
            'title'       => 'Tambah Pasien',
            'pasien'      => new Pasien(),
            'rumahSakits' => $rumahSakits,
            'route'       => route('pasiens.store'),
            'method'      => 'POST',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pasien'    => 'required|string|max:255',
            'alamat'         => 'nullable|string|max:255',
            'no_telpon'      => 'nullable|string|max:20',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        Pasien::create($data);

        return redirect()->route('pasiens.index')
            ->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function edit(Pasien $pasien)
    {
        $rumahSakits = RumahSakit::orderBy('nama_rumah_sakit')->get();

        return view('pasiens.form', [
            'title'       => 'Edit Pasien',
            'pasien'      => $pasien,
            'rumahSakits' => $rumahSakits,
            'route'       => route('pasiens.update', $pasien),
            'method'      => 'PUT',
        ]);
    }

    public function update(Request $request, Pasien $pasien)
    {
        $data = $request->validate([
            'nama_pasien'    => 'required|string|max:255',
            'alamat'         => 'nullable|string|max:255',
            'no_telpon'      => 'nullable|string|max:20',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        $pasien->update($data);

        return redirect()->route('pasiens.index')
            ->with('success', 'Pasien berhasil diupdate.');
    }

    /**
     * Hapus pasien via AJAX.
     */
    public function destroy(Pasien $pasien): JsonResponse
    {
        $pasien->delete();

        return response()->json([
            'message' => 'Pasien berhasil dihapus',
        ]);
    }

    /**
     * Filter pasien berdasarkan rumah_sakit_id (AJAX).
     *
     * @return JsonResponse
     */
    public function filter(Request $request): JsonResponse
    {
        $query = Pasien::with('rumahSakit');

        if ($request->filled('rumah_sakit_id')) {
            $query->where('rumah_sakit_id', $request->rumah_sakit_id);
        }

        $pasiens = $query->orderBy('nama_pasien')->get();

        return response()->json($pasiens);
    }
}
