<?php

namespace App\Http\Controllers\Account\UserPermission;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\DataTables\UserPermission\PermissionDataTable;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()    
                ->addColumn('action', function($row){

                    // $btn = '<button class="btn btn-primary waves-effect waves-light btn-sm" data-id="'.$row['id'].'"  id="edit"><i class="fas fa-pencil-alt"></i></button> ';

                    // $btn = $btn .'<button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$row['id'].'" id="delete"><i class="fas fa-trash-alt"></i></button> '. method_field('delete') . csrf_field() .'
                    // ';
                    
                    return '
                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'. $row->id .'" data-original-title="Edit"
                    class="edit btn btn-primary btn-sm editPermission"><i class="fas fa-edit"></i></a>
                    <a href="'.route('account.permission.destroy', $row->id).'" class="btn btn-danger btn-sm delete-item"><i class="fas fa-trash"></i></a>
                    ';
                    // return $btn;
                
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.account.permission.index');
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
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $request->id,
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = Permission::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                ]
            );
        
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Permission has been successfully saved']);
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
        $permission = Permission::findOrfail($id);
        return response()->json($permission);
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
        $permission = Permission::find($id);
        $permission->delete();
    }
}
