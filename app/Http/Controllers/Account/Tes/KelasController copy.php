<?php

namespace App\Http\Controllers\Account\Tes;

use App\Models\Eskul;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Kelas::with(['murid','mapel','eskul'])->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('account.kelas.edit', $row->id) . '" class="btn btn-primary btn-sm editItem"><i class="fas fa-edit"></i></a>
                        <a href="' . route('account.kelas.destroy', $row->id) . '" class="btn btn-danger btn-sm delete-item"><i class="fas fa-trash"></i></a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('pages.account.kelas.index');
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $murids = Murid::get();
        $mapels = Mapel::get();
        $eskuls= Eskul::get();
        return view('pages.account.kelas.create',compact('murids','mapels','eskuls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'murid' => 'required',
            'mapel' => 'required',
            'eskul' => 'required',
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = Kelas::updateOrCreate(
                ['id' => $request->id],
                [
                    'murid_id' => $request->murid,
                    'mapel_id' => $request->mapel,
                    'eskul_id' => $request->eskul,
                ]
            );
        
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Kelas has been successfully saved']);
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
    public function edit(Kelas $kelas)
    {
        $murids = Murid::get();
        $mapels = Mapel::get();
        $eskuls = Eskul::get();
        return view('pages.account.murid.edit', [
            'kelas' => $kelas,
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
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
    }
}
