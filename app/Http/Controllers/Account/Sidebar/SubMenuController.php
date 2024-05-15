<?php

namespace App\Http\Controllers\Account\Sidebar;

use App\Models\SubMenu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menu_item = MenuItem::get();
        if ($request->ajax()) {
            $data = SubMenu::orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()   
                ->addColumn('menu', function ($query) {
                    return $query->menu->menu_name;
                }) 
                ->addColumn('action', function($query){
                  
                    // $btn = '<button class="btn btn-primary waves-effect waves-light btn-sm" data-id="'.$row['id'].'"  id="edit"><i class="fas fa-pencil-alt"></i></button> ';

                    // $btn = $btn .'<button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$row['id'].'" id="delete"><i class="fas fa-trash-alt"></i></button> '. method_field('delete') . csrf_field() .'
                    // ';
                    
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'. $query->id .'" data-original-title="Edit"
                        class="edit btn btn-primary btn-sm editSubMenu"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$query['id'].'" id="deleteSubMenu"><i class="fas fa-trash-alt"></i></button>
                    ';
                    // return $btn;
                
                })
              
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.account.sub-menu.index',compact('menu_item'));
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
            'sub_name' => 'required|unique:sub_menus,sub_name,' . $request->id,
            'menu' => 'required',
            'route' => 'required|unique:sub_menus,route,' . $request->id,
            'sequence' => 'required',
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = SubMenu::updateOrCreate(
                ['id' => $request->id],
                [
                    'menu_id' => $request->menu,
                    'sub_name' => $request->sub_name,
                    'route' => $request->route,
                    'sequence' => $request->sequence,
                    'created_by' => auth()->user()->id,
                    'update_by' => auth()->user()->id,
                ]
            );
        
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Sub Menu has been successfully saved']);
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
        $submenu = SubMenu::with('menu')->findOrfail($id);
        return response()->json($submenu);
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
        $query = SubMenu::find($id)->delete();

        if($query){
            return response()->json(['code'=>1, 'msg'=>'Data has been deleted from database']);
        }else{
            return response()->json(['code'=>0, 'msg'=>'Something went wrong']);
        }
    }
}
