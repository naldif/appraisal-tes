<?php

namespace App\Http\Controllers\Account\Oauth;

use Auth;
use File;
use Exception;
use App\Models\User;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
        
            $finduser = User::where('gauth_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/account/dashboard');

            }else{
                $role = Role::where('name', 'User')->first();
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id'=> $user->id,
                    'gauth_type'=> 'google',
                    'password' => encrypt('password')
                ]);
                $newUser->assignRole($role);

                $detail_user = new DetailUser;
                $detail_user->users_id = $newUser->id;
                $detail_user->photo = NULL;
                $detail_user->save();

                Auth::login($newUser);

                return redirect('/account/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
