<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    public function index()
    {
        $rumahSakits = RumahSakit::orderBy('nama_rumah_sakit')->paginate(10);

        return view('rumah_sakit.index', compact('rumahSakits'))
            ->with('title', 'Data Rumah Sakit');
    }

    public function create()
    {
        return view('rumah_sakit.form')
            ->with([
                'title'       => 'Tambah Rumah Sakit',
                'rumahSakit'  => new RumahSakit(),
                'route'       => route('rumah-sakit.store'),
                'method'      => 'POST',
            ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat'           => 'nullable|string|max:255',
            'email'            => 'nullable|email|max:255',
            'telepon'          => 'nullable|string|max:20',
        ]);

        RumahSakit::create($data);

        return redirect()->route('rumah-sakit.index')
            ->with('success', 'Rumah sakit berhasil ditambahkan.');
    }

    public function edit(RumahSakit $rumah_sakit)
    {
        return view('rumah_sakit.form')
            ->with([
                'title'      => 'Edit Rumah Sakit',
                'rumahSakit' => $rumah_sakit,
                'route'      => route('rumah-sakit.update', $rumah_sakit),
                'method'     => 'PUT',
            ]);
    }

    public function update(Request $request, RumahSakit $rumah_sakit)
    {
        $data = $request->validate([
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat'           => 'nullable|string|max:255',
            'email'            => 'nullable|email|max:255',
            'telepon'          => 'nullable|string|max:20',
        ]);

        $rumah_sakit->update($data);

        return redirect()->route('rumah-sakit.index')
            ->with('success', 'Rumah sakit berhasil diupdate.');
    }

    public function destroy(RumahSakit $rumah_sakit)
    {
        $rumah_sakit->delete();

        return redirect()->route('rumah-sakit.index')
            ->with('success', 'Rumah sakit berhasil dihapus.');
    }
}
