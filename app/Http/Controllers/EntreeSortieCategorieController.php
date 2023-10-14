<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\EntreeSortieCategorie;

class EntreeSortieCategorieController extends Controller
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

        $depenses = EntreeSortieCategorie::select('id_categorie', 'status', DB::raw('SUM(montant) as totalMontant'))->groupBy('id_categorie', 'status')->get();

        $projets = Projet::all();
        $categories = Categorie::all();

        $dataParCategorie = [];

        // Regrouper les données par projet
        foreach ($depenses as $depense) {
            $idCategorie = $depense->id_categorie;
            if (!isset($dataParCategorie[$idCategorie])) {
                $dataParCategorie[$idCategorie] = [
                    'categorie' => Categorie::find($idCategorie),
                    'totalMontant' => 0,
                ];
            }
            $dataParCategorie[$idCategorie]['totalMontant'] += $depense->totalMontant;
        }

        $title = "Entrées/Sorties   -   WEB VISION  -  Gestion";

        return view('pages.app.expenses.expenses', ['dataParCategorie' => $dataParCategorie,'depenses' => $depenses, 'projets' => $projets, 'categories' => $categories])->with('title', $title);
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
        //dd($request->all());
        //
        $data = $request->validate([
            'nom' => 'required|unique:depenses',
            'description' => 'required',
            'montant' => 'required|numeric',
            'status' => 'required',
            'categorie' => 'required|exists:categories,id',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);
        //dd($data);

        $depense = new EntreeSortieCategorie();

        $depense->nom = $request->nom;
        $depense->description = $request->description;
        $depense->montant = $request->montant;
        $depense->status = (bool)$request->status;
        $depense->id_categorie = $request->categorie;

        //$entreeSortie->projet()->sync($entreeSortie->id_projet);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/EntreeSortieCategorie'), $filename);
            $depense->file = $filename;
        }

        $nomEntreeSortie = $depense->nom;

        $depense->save();

        session()->flash('success', 'L\'entrée/sortie "'.$nomEntreeSortie.'" a été ajouté avec succès.');
        return redirect()->route('expenses.index');
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

        $depenses = EntreeSortieCategorie::findOrFail($id);
        $alldepenses = EntreeSortieCategorie::all();


        $title = "Entrées/Sorties   -   WEB VISION  -  Gestion";

        return view('pages.app.expenses.view_simpleExpenses', ['depenses'=> $depenses, 'alldepenses'=> $alldepenses])->with('title', $title);
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
    public function update(Request $request, $entreeSortie)
    {
        //
        //dd($request->hasFile('file'));
        $data = $request->validate([
            'nom' => 'required|unique:depenses',
            'description' => 'required',
            'montant' => 'required|numeric',
            'status' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt', // Accepter uniquement les fichiers PDF, DOC et DOCX
            'categorie' => 'required|exists:categories,id',
        ]);

        $entreeSortie = EntreeSortieCategorie::findOrFail($entreeSortie);

        $entreeSortie->nom = $data['nom'];
        $entreeSortie->description = $data['description'];
        $entreeSortie->montant = $data['montant'];
        $entreeSortie->status = (bool)$data['status'];
        $entreeSortie->id_categorie = $data['categorie'];


        if ($request->hasFile('file')) {
            // S'il y a un nouveau fichier téléchargé, supprimez l'ancien fichier s'il existe
            if ($entreeSortie->file) {
                $filePath = public_path('uploads/EntreeSortieCategorie') . '/' . $entreeSortie->file;
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            // Enregistrez le nouveau fichier téléchargé
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/EntreeSortieCategorie/'), $filename);
            $data['file'] = $filename; // Mettez à jour le champ "file" dans la variable $data
        }

        $nomEntreeSortie = $entreeSortie->nom;
        //dd($entreeSortie);

        $entreeSortie->fill($data)->save();
        session()->flash('success', 'L\'entrée/sortie "'.$nomEntreeSortie.'" a été mis à jour avec succès.');
        session()->flash('error', 'Erreur.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        try {
            // Chercher le partenaire par son ID
            $entreeSortie = EntreeSortieCategorie::findOrFail($id);
            $entreeSortie->delete();
            if ($entreeSortie->file) {
                // Supprimer le fichier du système de fichiers
                $filePath = public_path('uploads/EntreeSortieCategorie') . '/' . $entreeSortie->file;
                File::delete($filePath);
            }
            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }

    }

    public function Categoriedestroy($id)
    {

        try {
                $categorie = Categorie::findOrFail($id);
                //$entreesSorties = EntreeSortie::findOrFail($id);

                foreach ($categorie->entreesSorties as $depense) {
                    // Supprimer le fichier s'il existe
                    if ($depense->file) {
                        $filePath = public_path('uploads/EntreeSortieCategorie') . '/' . $depense->file;
                        File::delete($filePath);
                    }
                    $depense->delete();
                }

                //$projet->entreesSorties()->detach();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }
    }

    public function Projetdestroy($id)
    {

        try {
                $projet = Projet::findOrFail($id);
                //$entreesSorties = EntreeSortie::findOrFail($id);

                foreach ($projet->entreesSorties as $depense) {
                    // Supprimer le fichier s'il existe
                    if ($depense->file) {
                        $filePath = public_path('uploads') . '/' . $depense->file;
                        File::delete($filePath);
                    }
                    $depense->delete();
                }

                //$projet->entreesSorties()->detach();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }
    }
}
