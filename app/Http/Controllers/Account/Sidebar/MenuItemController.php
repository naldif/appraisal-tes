<?php

namespace App\Http\Controllers\Account\Sidebar;

use App\Models\Module;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\DataTables\Sidebar\MenuItemDataTable;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $module = Module::get();
        if ($request->ajax()) {
            $data = MenuItem::orderBy('id','desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()   
                ->addColumn('module', function ($query) {
                    return $query->module->module_name;
                }) 
                ->addColumn('route', function ($query) {
                    return $query->route ? $query->route : '#';
                }) 
                ->addColumn('action', function($query){
                  
                    // $btn = '<button class="btn btn-primary waves-effect waves-light btn-sm" data-id="'.$row['id'].'"  id="edit"><i class="fas fa-pencil-alt"></i></button> ';

                    // $btn = $btn .'<button class="btn btn-danger waves-effect waves-light btn-sm" data-id="'.$row['id'].'" id="delete"><i class="fas fa-trash-alt"></i></button> '. method_field('delete') . csrf_field() .'
                    // ';
                    
                    return '
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'. $query->id .'" data-original-title="Edit"
                        class="edit btn btn-primary btn-sm editMenuItem"><i class="fas fa-edit"></i></a>
                        <a href="'.route('account.menu-item.destroy', $query->id).'" class="btn btn-danger btn-sm delete-item"><i class="fas fa-trash"></i></a>
                    ';
                    // return $btn;
                
                })
              
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.account.menu-item.index',compact('module'));
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
            'name' => 'required|unique:menu_items,menu_name,' . $request->id,
            'module' => 'required',
            'icon' => 'required',
            // 'route' => 'unique:menu_items,route,' . $request->id,
            'sequence' => 'required', 
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = MenuItem::updateOrCreate(
                ['id' => $request->id],
                [
                    'module_id' => $request->module,
                    'menu_name' => $request->name,
                    'icon' => $request->icon,
                    'route' => $request->route,
                    'sequence' => $request->sequence,
                    'created_by' => auth()->user()->id,
                    'update_by' => auth()->user()->id,
                ]
            );
        
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Menu Item has been successfully saved']);
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
        $menuItem = MenuItem::with('module')->findOrfail($id);
        return response()->json($menuItem);
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
        $menuItem = MenuItem::find($id);
        $menuItem->delete();
    }
}
