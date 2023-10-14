<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::orderBy('id', 'DESC')->get();
        $totalRoles = Role::count();

        $title = "Rôles   -   WEB VISION  -  Gestion";

        return view('pages.app.users.roles.role', ['roles'=> $roles,'title'=> $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.app.users.roles.role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'nom' => 'required|unique:roles',
            'description' => 'nullable',
        ]);

        $role = Role::create($data);
        $nomRole = $role->nom;

        // Vous pouvez enregistrer une activité ici dans la table de suivi des activités si nécessaire

        session()->flash('success', 'Le rôle "'.$nomRole.'" a été créé avec succès.');
        return redirect()->route('roles.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $role)
    {
        //
        $data = $request->validate([
            'nom' => 'required',
            'description' => 'nullable',
        ]);

        $role = Role::findOrFail($role);
        $role->nom = $data['nom'];
        $role->description = $data['description'];


        $nomRole = $role->nom;

        $role->save();

        // Vous pouvez enregistrer une activité ici dans la table de suivi des activités si nécessaire
        session()->flash('success', 'Le rôle "'.$nomRole.'" a été mis à jour avec succès.');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();

        $nomRole = $role->nom;

        // Vous pouvez enregistrer une activité ici dans la table de suivi des activités si nécessaire

        session()->flash('success', 'Le rôle "'.$nomRole.'" a été supprimé avec succès.');
        return redirect()->route('roles.index');
    }
}
