<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kalender;

class KalenderController extends Controller
{
    public function index()
    {
        $kalenders = Kalender::all();

        return response()->json([
            'success' => true,
            'data' => $kalenders,
        ]);
    }

    public function create()
    {
        // Tidak perlu diisi karena ini adalah endpoint untuk menampilkan formulir pembuatan baru
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string',
            'note' => 'required|string',
            'date' => 'required|dataTme',
        ]);

        // Simpan data ke dalam database
        $kalender = Kalender::create($validateData);

        return response()->json([
            'success' => true,
            'message' => 'Kalender berhasil disimpan',
            'data' => $kalender,
        ]);
    }

    public function show($title)
    {
        $kalender = Kalender::where('title', $title)->first();

        if (!$kalender) {
            return response()->json([
                'success' => false,
                'message' => 'Kalender not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kalender,
        ]);
    }

    public function edit($title)
    {
        // Tidak perlu diisi karena ini adalah endpoint untuk menampilkan formulir edit
    }

    public function update(Request $request, $title)
    {
        $validateData = $request->validate([
            'title' => 'required|string',
            'note' => 'required|string',
            'date' => 'required|dataTme',
        ]);

        // Temukan kalender berdasarkan title
        $kalender = Kalender::where('title', $title)->first();

        if (!$kalender) {
            return response()->json([
                'success' => false,
                'message' => 'Kalender not found',
            ], 404);
        }

        // Perbarui data kalender dengan data yang divalidasi
        $kalender->update($validateData);

        return response()->json([
            'success' => true,
            'message' => 'Kalender berhasil diupdate',
            'data' => $kalender,
        ]);
    }

    public function destroy($title)
    {
        // Temukan kalender berdasarkan title
        $kalender = Kalender::where('title', $title)->first();

        if (!$kalender) {
            return response()->json([
                'success' => false,
                'message' => 'Kalender not found',
            ], 404);
        }

        // Hapus kalender
        $kalender->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kalender berhasil dihapus',
        ]);
    }
}
