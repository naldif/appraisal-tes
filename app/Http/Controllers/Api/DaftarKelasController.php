<?php

namespace App\Http\Controllers\Api;

use App\Models\Kelas;
use App\Models\DaftarKelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DaftarKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftar = DaftarKelas::with(['kelas', 'eskul', 'mapel', 'murid'])->get();

        // Inisialisasi array kosong untuk menampung data yang diformat
        
        // Loop melalui setiap item dalam $daftar
        foreach ($daftar as $item) {
            // Ambil nama kelas
   
            $dataKelas[] = [
                'nama_kelas' => $item->kelas->nama_kelas,
                'nama_murid' => $item->murid->nama_murid,
                'nama_mapel' => $item->mapel->nama_mapel,
                'nama_eskul' => $item->eskul->nama_eskul,
                'makmial_kelas' => $item->kelas->maksimal
            ];
            
            // Tambahkan data kelas ke dalam array formattedData
            $formattedData = [
                'data' => $dataKelas,
            ];
        }
        
        // Return with JSON response
        return response()->json([
            'success' => true,
            'message' => 'List Data Murid yang terdaftar',
            'data' => $dataKelas,
        ], 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pastikan semua input yang diperlukan tersedia
        if (!$request->has(['kelas', 'murid', 'mapel', 'eskul'])) {
            return response()->json([
                'success' => false,
                'message' => 'Semua input diperlukan.',
                'data'    => 'error',
            ], 400);
        }
        
        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'murid' => 'required',
            'mapel' => 'required',
            'eskul' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        // Dapatkan informasi kelas
        $kelas = Kelas::find($request->kelas);
        
        if (!$kelas) {
            return response()->json([
                'success' => false,
                'message' => 'Kelas tidak ditemukan.',
                'data'    => 'error',
            ], 404);
        }
        
        // Hitung jumlah murid dalam kelas
        $jumlah_murid = DaftarKelas::where('kelas_id', $request->kelas)->count();
        
        // Validasi apakah jumlah murid dalam kelas telah mencapai maksimal
        if ($jumlah_murid >= $kelas->maksimal) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak bisa mendaftar kelas, karena kelas sudah mencapai batas maksimal murid.',
                'data'    => 'error',
            ], 400);
        }
        
        // Validasi jika eskul nomor 3 harus memiliki lebih dari satu murid
        if ($request->eskul == 3) {
            $jumlah_murid_eskul_3 = DaftarKelas::where('eskul_id', 3)->count();
            if ($jumlah_murid_eskul_3 <= 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Eskul nomor 3 harus memiliki lebih dari satu murid.',
                    'data'    => 'error',
                ], 400);
            }
        }
        
        // Tambahkan murid ke kelas
        $data = DaftarKelas::create([
            'kelas_id' => $request->kelas,
            'murid_id' => $request->murid,
            'mapel_id' => $request->mapel,
            'eskul_id' => $request->eskul,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Data Eskul berhasil dibuat!',
            'data'    => $data,
        ], 200);        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
