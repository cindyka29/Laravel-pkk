<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iuran;

class iuranController extends Controller
{
   
    public function index()
    {
        $iurans = iuran::all();

        return response()->json([
            'success' => true,
            'data' => $iurans,
        ]);
    }
  
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|string',
            'jenisKegiatan' => 'required|string',
            'buktiPembayaranPath' => 'required|image', // Ubah validasi untuk gambar
            'nominalUang' => 'required|integer',
        ]);

        try {
            if ($request->file('image')) {
                $validateData['image'] = $request->file('image')->store('post-images'); // Ubah folder penyimpanan
            }

            $iuran = iuran::create($validateData);

            if ($iuran) { // Periksa jika pembuatan post berhasil
                return response()->json([
                    'success' => true,
                    'message' => 'Iuran berhasil dibuat',
                    'data' => $iuran
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Iuran gagal dibuat',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $e->getMessage()
            ]);
        }
    }

    public function show($nama)
    {
         $iuran = iuran::find($nama);

        if (!$iuran) {
            return response()->json([
                'success' => false,
                'message' => 'Iuran not found',
            ], 404);
        }

        return response()->json([
            'success' => true, // Perbaiki tanda petik tunggal menjadi ganda
            'data' => $iuran,
        ]);
    }

    public function edit($nama)
    {
        //
    }

    public function update(Request $request, $nama)
    {
        $validateData = $request->validate([
            'nama' => 'required|string',
            'jenisKegiatan' => 'required|string',
            'buktiPembayaranPath' => 'required|image', // Ubah validasi untuk gambar
            'nominalUang' => 'required|int',
        ]);

        try {
            $iuran = iuran::findOrFail($nama);

            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($iuran->image) {
                    Storage::delete($iuran->image);
                }
                // Simpan gambar baru
                $validateData['image'] = $request->file('image')->store('post-images'); // Ubah folder penyimpanan
            }

            // Perbarui data post dengan data yang divalidasi
            $iuran->nama = $validateData['nama'];
            $iuran->jenisKegiatan = $validateData['jenisKegiatan'];
            $iuran->nominalUang = $validateData['nominalUang'];
            $iuran->buktiPembayaranPath = $validateData['buktiPembayaranPath'];

            $iuran->save();

            return response()->json([
                'success' => true,
                'message' => 'Iuran berhasil di edit',
                'data' => $iuran
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error',
                'errors' => $e->getMessage()
            ]);
        }
    }

  
    public function destroy($nama)
    {
        $iuran = iuran::find($nama);

        if (!$iuran) {
            return response()->json([
                'success' => false,
                'message' => 'Iuran not found',
            ], 404);
        }
        // Hapus gambar terkait jika ada
        if ($iuran->image) {
            Storage::delete($iuran->image);
        }

        $iuran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Iuran deleted successfully',
        ]);
    }
}
