<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasUmum;

class kasumumController extends Controller
{
  
    public function index()
    {
        $kasumum = KasUmum::all();

        return response()->json([
            'success' => true,
            'data' => $kasumum,
        ]);
    }

 
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required|int',
            'keterangan' => 'required|string',
            'jumlah' => 'required|int',
            'tanggal' => 'required|DateTime',
            'isPemasukan' => 'required|boolean',
        ]);

        $kasumum = new KasUmum(); // Untuk metode store
        $kasumum->id = $validateData['id'];
        $kasumum->keterangan = $validateData['keterangan'];
        $kasumum->jumlah = $validateData['jumlah'];
        $kasumum->tanggal = $validateData['tanggal'];
        $kasumum->isPemasukan = $validateData['isPemasukan'];

        $kasumum->save();

        return response()->json([
            'success' => true,
            'message' => 'KasUmum berhasil disimpan',
            'data' => $kasumum,
        ]);
    }

 
    public function show($id)
    {
        $kasumum = KasUmum::find($id);

        if (!$kasumum) {
            return response()->json([
                'success' => false,
                'message' => 'KasUmum not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kasumum,
        ]);
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'id' => 'required|int',
            'keterangan' => 'required|string',
            'jumlah' => 'required|int',
            'tanggal' => 'required|DateTime',
            'isPemasukan' => 'required|boolean',
        ]);

        $kasumum = KasUmum::find($id);

        if (!$kasumum) {
            return response()->json([
                'success' => false,
                'message' => 'KasUmum not found',
            ], 404);
        }

        $kasumum->id = $validateData['id'];
        $kasumum->keterangan = $validateData['keterangan'];
        $kasumum->jumlah = $validateData['jumlah'];
        $kasumum->tanggal = $validateData['tanggal'];
        $kasumum->isPemasukan = $validateData['isPemasukan'];

        $kasumum->save();

        return response()->json([
            'success' => true,
            'message' => 'KasUmum berhasil diupdate',
            'data' => $kasumum,
        ]);
    }

  
    public function destroy($id)
    {
        $kasumum = KasUmum::find($id);

        if (!$kasumum) {
            return response()->json([
                'success' => false,
                'message' => 'KasUmum not found',
            ], 404);
        }

        $kasumum->delete();

        return response()->json([
            'success' => true,
            'message' => 'KasUmum berhasil dihapus',
        ]);
    }
}
