<?php

namespace App\Http\Controllers\Account\Tes;

use App\Models\Eskul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class EskulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Eskul::orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'. $row->id .'" data-original-title="Edit"
                        class="edit btn btn-primary btn-sm editEskul" style="margin-right:5px"><i class="fas fa-edit"></i></a>
                        <a href="' . route('account.eskul.destroy', $row->id) . '" class="btn btn-danger btn-sm delete-item"><i class="fas fa-trash"></i></a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('pages.account.eskul.index');
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
        
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = Eskul::updateOrCreate(
                ['id' => $request->id],
                [
                    'nama_eskul' => $request->nama_eskul,
                ]
            );
        
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Eskul has been successfully saved']);
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
    public function edit(string $id)
    {
        $eskul = Eskul::findOrfail($id);
        return response()->json($eskul);
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
        $eskul = Eskul::findOrFail($id);
        $eskul->delete();
    }
}
