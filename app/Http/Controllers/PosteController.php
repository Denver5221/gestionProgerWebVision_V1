<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Http\Request;

class PosteController extends Controller
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
        //

        $postes = Poste::all();
        $totalPostes = Poste::count();
        return view('pages.app.users.poste', compact('postes', 'totalPostes'), ['postes' => $postes,'totalPostes' => $totalPostes ,'title' => 'Postes |  WEB VISION  -  Gestion ', 'breadcrumb' => 'This Breadcrumb']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nom' => 'required|unique:postes',
        ]);

        $poste = Poste::create($data);
        $nomPoste = $poste->nom;

        // Vous pouvez enregistrer une activité ici dans la table de suivi des activités si nécessaire

        session()->flash('success', 'Le poste "'.$nomPoste.'" a été créé avec succès.');
        return redirect()->route('postes.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $poste)
    {
        //
        $data = $request->validate([
            'nom' => 'required',
        ]);

        $poste = Poste::findOrFail($poste);
        $poste->nom = $data['nom'];


        $nomPoste = $poste->nom;

        $poste->save();

        // Vous pouvez enregistrer une activité ici dans la table de suivi des activités si nécessaire
        session()->flash('success', 'Le poste "'.$nomPoste.'" a été mis à jour avec succès.');
        return redirect()->route('postes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poste $poste)
    {
        //
        $poste->delete();

        $nomPoste = $poste->nom;

        // Vous pouvez enregistrer une activité ici dans la table de suivi des activités si nécessaire

        session()->flash('success', 'Le poste "'.$nomPoste.'" a été supprimé avec succès.');
        return redirect()->route('postes.index');
    }
}
