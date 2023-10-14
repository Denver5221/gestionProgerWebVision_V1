<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Role;
use App\Models\Poste;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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


        

        $postes = Poste::all();
        $roles = Role::all();


        Validator::make($input, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => [ 'required', 'string', 'email', 'max:255', Rule::unique(User::class),],
            'telephone' => ['required', 'string', 'max:255'],
            'id_poste' => 'required|exists:postes,id',
            'id_role' => 'required|exists:roles,id',
            'password' => $this->passwordRules(),

        ])->validate();


        $poste = Poste::find($input['id_poste']);
        $role = Role::find($input['id_role']);


        $user = User::create([
            'nom' => $input['nom'],
            'prenom' => $input['prenom'],
            'email' => $input['email'],
            'telephone' => $input['telephone'],
            'id_poste' => $input['id_poste'],
            'id_role' => $input['id_role'],
            'password' => Hash::make($input['password']),
        ]);

        $user->poste()->associate($poste);
        $user->roles()->sync([$role->id]);

        $user->save();

        return $user;
    }
}
