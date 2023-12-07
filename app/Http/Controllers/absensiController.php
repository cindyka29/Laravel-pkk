<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensi = Absensi::all();

        
        return response()->json([
            'success' => true,
            'data' => $absensi,
        ]);
    }

    public function create()
    {
        // Tidak perlu melakukan apa-apa di sini, karena ini adalah tampilan form
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'hadir' => 'required|string',
            'tidakHadir' => 'required|string',
            'alasanTidakHadir' => 'required|string',
            'tanggal' => 'required',
            'kegiatan' => 'required|string',
        ]);

        $absensi = new Absensi(); // Untuk metode store
        $absensi->nama = $validateData['nama'];
        $absensi->jabatan = $validateData['jabatan'];
        $absensi->hadir = $validateData['hadir'];
        $absensi->tidakHadir = $validateData['tidakHadir'];
        $absensi->alasanTidakHadir = $validateData['alasanTidakHadir'];
        $absensi->tanggal = $validateData['tanggal'];
        $absensi->kegiatan = $validateData['kegiatan'];

        $absensi->save();

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil disimpan',
            'data' => $absensi,
        ]);
    }

    public function show($nama)
    {
        $absensi = Absensi::find($nama);

        if (!$absensi) {
            return response()->json([
                'success' => false,
                'message' => 'Absensi not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $absensi,
        ]);
    }

    public function update(Request $request, $nama)
    {
        $validateData = $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'hadir' => 'required|string',
            'tidakHadir' => 'required|string',
            'alasanTidakHadir' => 'required|string',
            'tanggal' => 'required',
            'kegiatan' => 'required|string',
        ]);

        $absensi = Absensi::find($nama);

        if (!$absensi) {
            return response()->json([
                'success' => false,
                'message' => 'Absensi not found',
            ], 404);
        }

        $absensi->nama = $validateData['nama'];
        $absensi->jabatan = $validateData['jabatan'];
        $absensi->hadir = $validateData['hadir'];
        $absensi->tidakHadir = $validateData['tidakHadir'];
        $absensi->alasanTidakHadir = $validateData['alasanTidakHadir'];
        $absensi->tanggal = $validateData['tanggal'];
        $absensi->kegiatan = $validateData['kegiatan'];

        $absensi->save();

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil diupdate',
            'data' => $absensi,
        ]);
    }

    public function destroy($nama)
    {
        $absensi = Absensi::find($nama);

        if (!$absensi) {
            return response()->json([
                'success' => false,
                'message' => 'Absensi not found',
            ], 404);
        }

        $absensi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil dihapus',
        ]);
    }
}
