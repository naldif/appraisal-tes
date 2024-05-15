<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        //set validasi
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //create donatur
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        $detail_user = new DetailUser;
        $detail_user->users_id = $user->id;
        $detail_user->photo = NULL;
        
        $detail_user->save();
        
        $token = $user->createToken('auth_token')->plainTextToken;
        //return JSON
        return response()->json([
            'success' => true,
            'message' => 'Register Berhasil!',
            'data'    => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
    }
}
