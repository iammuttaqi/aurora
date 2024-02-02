<?php

namespace App\Actions\Fortify;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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
        Validator::make(
            $input,
            [
                'role_id'  => ['required', Rule::in(Role::idsInArray('user'))],
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms'    => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ],
            [],
            [
                'role_id' => 'Role',
            ],
        )->validate();

        DB::beginTransaction();
        try {
            $user = User::create([
                'role_id'  => $input['role_id'],
                'name'     => $input['name'],
                'email'    => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            $profile = $user->profile()->create([
                'name'     => $user->name,
                'email_1'  => $user->email,
                'username' => null,
            ]);

            DB::commit();
            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            logger(__METHOD__, [$th]);
            throw $th;
        }
    }
}
