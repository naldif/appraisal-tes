<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\DetailUser;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $role = Role::where('name', 'User')->first();

        $user = User::create([
            'name'     => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        
        $user->assignRole($role);

        $detail_user = new DetailUser;
        $detail_user->users_id = $user->id;
        $detail_user->photo = NULL;
        
        $detail_user->save();
        return $user;
    }
}
