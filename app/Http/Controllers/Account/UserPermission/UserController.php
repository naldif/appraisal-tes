<?php

namespace App\Http\Controllers\Account\UserPermission;

use App\Models\User;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\DataTables\UserPermission\UserDataTable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return DataTables::of($data)
                ->addIndexColumn()    
                ->addColumn('role', function($query) {
                    $roles = [];
                    foreach ($query->roles as $role) {
                        $roles[] = $role->name;
                    }
                    return implode(', ', $roles); 
                })
        
                ->addColumn('action', function($row){
                  
                    // $btn = '<button class="btn btn-primary waves-effect waves-light btn-sm" data-id="'.$row['id'].'"  id="edit"><i class="fas fa-pencil-alt"></i></button> ';

                    // $btn = $btn .'<button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$row['id'].'" id="delete"><i class="fas fa-trash-alt"></i></button> '. method_field('delete') . csrf_field() .'
                    // ';
                    
                    return '
                    <a href="'.route('account.user.edit', $row->id).'" class="btn btn-primary btn-sm editUser"><i class="fas fa-edit"></i> </a>
                    <a href="'.route('account.user.destroy', $row->id).'" class="btn btn-danger btn-sm delete-item"><i class="fas fa-trash"></i></a>
                    ';
                    // return $btn;
                
                })
              
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.account.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('pages.account.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $users)
    {
        $rules = [
            'name'  => 'required|max:128',
            'email' => 'required|email',
            'contact_number' => 'required',
            'roles' => 'required|array',
        ];

        if ($request->id == '') { // Jika ini adalah permintaan pembuatan data baru
            $rules['photo'] = 'required|image|max:500';
            $rules['password'] = 'required|string|min:5|max:8';
        } else { // Jika ini adalah permintaan pembaruan data
            $rules['photo'] = 'nullable|image|max:500';
            $rules['password'] = 'nullable|string|min:5|max:8';
        }

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }else{

            // Mengelola User
            $user = User::updateOrCreate(
                ['id' => $request->id],
                [
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => $request->password ? Hash::make($request->password) : Hash::make('password'),
                ]
            );
            $user->syncRoles($request->roles);

    
            // Mengelola DetailUser
            if (isset($request->id)) { // Jika ini adalah permintaan pembaruan data
                $detailUser = DetailUser::where('users_id', $user->id)->first();

                $filePath = uploadFile('photo','users', $detailUser);

                $detailUser->contact_number = $request->contact_number;
                $detailUser->photo = (!empty($filePath) ? $filePath : $detailUser->photo);
                $detailUser->save();

            } else { // Jika ini adalah permintaan pembuatan data baru
                $filePath = uploadFile('photo','users');

                $detailUser = new DetailUser;
                $detailUser->users_id = $user->id;
                $detailUser->contact_number = $request->contact_number;
                $detailUser->photo = !empty($filePath) ? $filePath : null;
                $detailUser->save();
            }
            
    
            if (!$user) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'User has been successfully saved']);
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
    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('pages.account.user.edit', [
            'users' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
        
        return view('pages.account.user.edit', compact('users','roles'));
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
        $user = User::findOrFail($id);
        $user->delete();
    }
}
