<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class anggotaController extends Controller
{
    
    public function index()
    {
        $anggota = Anggota::all();

        return response()->json([
            'success' => true,
            'data' => $anggota,
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
            'jabatan' => 'required|string',
            'pokja' => 'required|boolean',
            'iamge' => 'required|boolean',
            'status' => 'required|string',
        ]);

        $anggota = new Anggota(); // Untuk metode store
        $anggota->nama = $validateData['nama'];
        $anggota->jabatan = $validateData['jabatan'];
        $anggota->pokja = $validateData['pokja'];
        $anggota->image = $validateData['image'];
        $anggota->status = $validateData['status'];

        $anggota->save();

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil disimpan',
            'data' => $anggota,
        ]);
    }


    public function show($id)
    {
        $anggota = Anggota::find($nama);

        if (!$anggota) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $anggota,
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'pokja' => 'required|string',
            'image' => 'required|string',
            'status' => 'required|string',
        ]);

        $anggota = Anggota::find($nama);

        if (!$anggota) {
            return response()->json([
                'success' => false,
                'message' => 'Anggota not found',
            ], 404);
        }

        $anggota->nama = $validateData['nama'];
        $anggota->jabatan = $validateData['jabatan'];
        $anggota->pokja = $validateData['pokja'];
        $anggota->image = $validateData['image'];
        $anggota->status = $validateData['status'];

        $anggota->save();

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil diupdate',
            'data' => $anggota,
        ]);
    }

 
    public function destroy($id)
    {
        $anggota = Anggota::find($nama);

        if (!$anggota) {
            return response()->json([
                'success' => false,
                'message' => 'Aggota not found',
            ], 404);
        }

        $anggota->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anggota berhasil dihapus',
        ]);
    }
}
