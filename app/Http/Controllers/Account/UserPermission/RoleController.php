<?php

namespace App\Http\Controllers\Account\UserPermission;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\DataTables\UserPermission\RoleDataTable;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::get();
            return DataTables::of($data)
                ->addIndexColumn()    
                ->addColumn('permission', function($query) {
                    $permissions = [];
                    foreach ($query->permissions as $permission) {
                        $permissions[] = '<span class="badge bg-primary">' . $permission->name . '</span>';
                    }
                    return implode(' ', $permissions);
                })
        
                ->addColumn('action', function($row){
                  
                    // $btn = '<button class="btn btn-primary waves-effect waves-light btn-sm" data-id="'.$row['id'].'"  id="edit"><i class="fas fa-pencil-alt"></i></button> ';

                    // $btn = $btn .'<button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$row['id'].'" id="delete"><i class="fas fa-trash-alt"></i></button> '. method_field('delete') . csrf_field() .'
                    // ';
                    
                    return '
                        <a href="'.route('account.role.edit', $row->id).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> </a>
                        <a href="'.route('account.role.destroy', $row->id).'" class="btn btn-danger btn-sm delete-item"><i class="fas fa-trash"></i></a>
                    ';
                    // return $btn;
                
                })
              
                ->rawColumns(['action','permission'])
                ->make(true);
        }
        return view('pages.account.role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        // $permissions = Permission::groupBy('name')->get();
        // dd($permissions);
        return view('pages.account.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $request->id,
            'permissions' => 'required|array', // Ubah 'permission' menjadi 'permissions' dan tambahkan aturan 'array'
            'permissions.*' => 'exists:permissions,id', // Pastikan semua permission yang dikirim ada dalam tabel permissions
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $role = Role::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                ]
            );
        
            // Ubah cara Anda mendapatkan permissions
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissions);

            if (!$role) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Role has been successfully saved']);
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
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('pages.account.role.edit',compact('role','permissions','rolePermissions'));
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
        $role = Role::findOrFail($id);
        $role->delete();
    }
}
