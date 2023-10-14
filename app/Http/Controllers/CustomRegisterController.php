<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use App\Models\Role;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// use App\Actions\Fortify\PasswordValidationRules;


use Illuminate\Http\Request;

class CustomRegisterController extends Controller
{
    //

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function showRegistrationForm()
    {
        $postes = Poste::all();
        $roles = Role::all();

        return view('auth.register', compact('postes', 'roles'));
    }

    public function showUsersList()
    {
        $users = User::all();
        $users = Role::all();
        $users = Poste::all();

        $title = "Titre de la page d'inscription";


        $users = User::with(['poste', 'roles'])->latest('created_at')->get();

        return view('pages.app.users.users', ['users' => $users])->with('title', $title);
    }



    public function showUserProfile($userId)
    {
        $user = User::find($userId);
        $title = "Titre de la page d'inscription";
        return view('pages.app.users.profile', compact('user'))->with('title', $title);
    }



    public function edit(User $user)
    {
        $postes = Poste::all();
        $roles = Role::all();

        $title = "Titre de la page d'inscription";

        return view('pages.app.users.settings', compact('user', 'postes', 'roles'))->with('title', $title);
    }



    public function update(Request $request,User $user)
    {



        //$user->roles()->sync($request->roles);
        //$user->poste()->associate($request->postes);

        // $data = $request->validate([
        //     'nom' => 'required',
        //     'prenom' => 'required',
        //     'email' => 'required',
        //     'id_role' => 'required|exists:roles,id',
        //     'id_poste' => 'required|exists:postes,id',
        //     'telephone' => 'required',
        //     'password' => 'required|min:8',
        // ]);

        // $role = Role::find($input['id_role']);
        // $poste = Poste::find($input['id_poste']);
        // $user = User::findOrFail($users);


        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->id_role = $request->roles;
        $user->id_poste = $request->postes;
        $user->telephone = $request->telephone;
        $user->password = Hash::make($request->password);

         $user->poste()->associate($user->id_poste);
         $user->roles()->sync([$user->id_role]);

         $user->save();

        // session()->flash('success', 'Le poste a été mis à jour avec succès.');
        return redirect()->route('user.profile', $user);
    }


}
