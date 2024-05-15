<?php

namespace App\Http\Controllers\Account\Tes;

use App\Models\Eskul;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use App\Models\DaftarKelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DaftarKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DaftarKelas::with(['kelas','murid','mapel','eskul'])->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('account.daftar.edit', $row->id) . '" class="btn btn-primary btn-sm editItem"><i class="fas fa-edit"></i></a>
                        <a href="' . route('account.daftar.destroy', $row->id) . '" class="btn btn-danger btn-sm delete-item"><i class="fas fa-trash"></i></a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('pages.account.daftar.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::get();
        $murids = Murid::get();
        $mapels = Mapel::get();
        $eskuls= Eskul::get();
        return view('pages.account.daftar.create',compact('kelas','murids','mapels','eskuls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelas' => 'required',
            'murid' => 'required',
            'mapel' => 'required',
            'eskul' => 'required',
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            // Maksimal 
            $kelas = Kelas::where('id', $request->kelas)->first();
 
            // Periksa jumlah kelas
            $jumlah_kelas = DaftarKelas::where('kelas_id', $request->kelas)->count();
            // Validasi apakah jumlah kelas telah mencapai maksimal
            if ($jumlah_kelas >= $kelas->maksimal) {
                return response()->json(['code' => 0, 'msg' => 'Tidak bisa mendaftar kelas, karena kelas sudah maksimal']);
            }else{
                $query = DaftarKelas::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'kelas_id' => $request->kelas,
                        'murid_id' => $request->murid,
                        'mapel_id' => $request->mapel,
                        'eskul_id' => $request->eskul,
                    ]
                );
            
                if (!$query) {
                    return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
                } else {
                    return response()->json(['code' => 1, 'msg' => 'Daftar Kelas has been successfully saved']);
                }
            }
        }
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
    public function edit(DaftarKelas $daftar)
    {
        $kelas = Kelas::get();
        $murids = Murid::get();
        $mapels = Mapel::get();
        $eskuls = Eskul::get(); 
        return view('pages.account.daftar.edit', [
            'daftar' => $daftar,
            'kelas'  => $kelas,
            'murids' => $murids,
            'mapels' => $mapels,
            'eskuls' => $eskuls,
        ]);
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
        $daftar = DaftarKelas::findOrFail($id);
        $daftar->delete();
    }
}
