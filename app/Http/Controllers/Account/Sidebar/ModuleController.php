<?php

namespace App\Http\Controllers\Account\Sidebar;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\DataTables\Sidebar\ModuleDataTable;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Module::orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()    
                ->addColumn('action', function($query){
                  
                    // $btn = '<button class="btn btn-primary waves-effect waves-light btn-sm" data-id="'.$row['id'].'"  id="edit"><i class="fas fa-pencil-alt"></i></button> ';

                    // $btn = $btn .'<button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$row['id'].'" id="delete"><i class="fas fa-trash-alt"></i></button> '. method_field('delete') . csrf_field() .'
                    // ';
                    
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'. $query->id .'" data-original-title="Edit"
                        class="edit btn btn-primary btn-sm editModule"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$query['id'].'" id="deleteModule"><i class="fas fa-trash-alt"></i></button>
                    ';
                    // return $btn;
                
                })
              
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.account.module.index');
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
            'name' => 'required|unique:modules,module_name,' . $request->id,
            'sequence' => 'required'
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = Module::updateOrCreate(
                ['id' => $request->id],
                [
                    'module_name' => $request->name,
                    'sequence' => $request->sequence,
                ]
            );
        
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Module has been successfully saved']);
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
        $module = Module::findOrfail($id);
        return response()->json($module);
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
        $query = Module::find($id)->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Data has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }
    }
}
