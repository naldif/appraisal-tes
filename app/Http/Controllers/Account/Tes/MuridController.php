<?php

namespace App\Http\Controllers\Account\Tes;

use App\Models\Murid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MuridController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Murid::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('account.murid.edit', $row->id) . '" class="btn btn-primary btn-sm editItem"><i class="fas fa-edit"></i></a>
                        <a href="' . route('account.murid.destroy', $row->id) . '" class="btn btn-danger btn-sm delete-item"><i class="fas fa-trash"></i></a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('pages.account.murid.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.account.murid.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_murid' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = Murid::updateOrCreate(
                ['id' => $request->id],
                [
                    'nama_murid' => $request->nama_murid,
                    'telepon' => $request->telepon,
                    'alamat' => $request->alamat,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]
            );
        
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Murid has been successfully saved']);
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
    public function edit(Murid $murid)
    {
        return view('pages.account.murid.edit', [
            'murid' => $murid,
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
        $murid = Murid::findOrFail($id);
        $murid->delete();
    }
}
