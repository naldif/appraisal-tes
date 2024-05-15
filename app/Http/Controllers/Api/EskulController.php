<?php

namespace App\Http\Controllers\Api;

use App\Models\Eskul;
use App\Models\DaftarKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // Ambil semua daftar kelas beserta relasi mapel dan murid
         $daftar = DaftarKelas::with(['eskul'])
         ->select('eskul_id', DB::raw('COUNT(eskul_id) as total_murid'))
         ->groupBy('eskul_id')
         ->get();

        // Return dengan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'List Mapel beserta Total Murid',
            'data' => $daftar,
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
        $validator = Validator::make($request->all(), [
            'nama_eskul' => 'required|unique:eskuls,nama_eskul,' . $request->id,
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = Eskul::create([
            'nama_eskul'      => $request->nama_eskul,
        ]);
    
       //return with response JSON
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
