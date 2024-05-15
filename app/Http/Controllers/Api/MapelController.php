<?php

namespace App\Http\Controllers\Api;

use App\Models\DaftarKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua daftar kelas beserta relasi mapel dan murid
        $daftar = DaftarKelas::with(['mapel'])
            ->select('mapel_id', DB::raw('COUNT(murid_id) as total_murid'))
            ->groupBy('mapel_id')
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
        //
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
