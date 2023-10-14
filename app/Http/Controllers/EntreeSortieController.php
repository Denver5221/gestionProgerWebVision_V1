<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Categorie;
use App\Models\EntreeSortie;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\EntreeSortieCategorie;

class EntreeSortieController extends Controller
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
    public function index(Projet $projets)
    {
        //
        $entreesSorties = EntreeSortie::select('id_projet', 'status', 'montant')->groupBy('id_projet', 'status', 'montant')->get();
        $projets = Projet::all();
        $depenses = EntreeSortieCategorie::all();
        $categories = Categorie::all();
        //dd($projets->all());

        $dataParProjet = [];


        // Regrouper les données par projet
        foreach ($entreesSorties as $entreeSortie) {
            $idProjet = $entreeSortie->id_projet;
            if (!isset($dataParProjet[$idProjet])) {
                $dataParProjet[$idProjet] = [
                    'projet' => Projet::find($idProjet),
                    'totalEntrees' => 0,
                    'totalSorties' => 0,
                    'difference' => 0,
                ];
            }
            if ($entreeSortie->status == 0) {
                $dataParProjet[$idProjet]['totalEntrees'] += $entreeSortie->montant;
            } else {
                $dataParProjet[$idProjet]['totalSorties'] += $entreeSortie->montant;
            }
            $dataParProjet[$idProjet]['difference'] = $dataParProjet[$idProjet]['totalEntrees'] - $dataParProjet[$idProjet]['totalSorties'];
        }
        //dd($dataParProjet);


        $depenses = EntreeSortieCategorie::select('id_categorie', 'status', 'montant')->groupBy('id_categorie', 'status', 'montant')->get();

        $projets = Projet::all();
        $categories = Categorie::all();

        $dataParCategorie = [];

        // Regrouper les données par projet
        foreach ($depenses as $depense) {
            $idCategorie = $depense->id_categorie;
            if (!isset($dataParCategorie[$idCategorie])) {
                $dataParCategorie[$idCategorie] = [
                    'categorie' => Categorie::find($idCategorie),
                    'totalEntrees' => 0,
                    'totalSorties' => 0,
                    'difference' => 0,
                ];
            }
            if ($depense->status == 0) {
                $dataParCategorie[$idCategorie]['totalEntrees'] += $depense->montant;
            } else {
                $dataParCategorie[$idCategorie]['totalSorties'] += $depense->montant;
            }
            $dataParCategorie[$idCategorie]['difference'] = $dataParCategorie[$idCategorie]['totalEntrees'] - $dataParCategorie[$idCategorie]['totalSorties'];
        }

        $title = "Entrées/Sorties   -   WEB VISION  -  Gestion";

        return view('pages.app.expenses.expenses', ['dataParProjet' => $dataParProjet, 'dataParCategorie' => $dataParCategorie, 'projets'=> $projets, 'depenses'=> $depenses, 'categories'=> $categories])->with('title', $title);
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
        $request->validate([
            'nom' => 'required|unique:depenses',
            'description' => 'required',
            'montant' => 'required|numeric',
            'status' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx', // Par exemple, accepter uniquement les fichiers PDF, DOC et DOCX
            'id_projet' => 'required|exists:projets,id',
        ]);

        // Créer une nouvelle instance du modèle "EntreeSortie"
        $entreeSortie = new EntreeSortie();

        // Remplir les propriétés de l'objet avec les données du formulaire
        $entreeSortie->nom = $request->nom;
        $entreeSortie->description = $request->description;
        $entreeSortie->montant = $request->montant;
        $entreeSortie->status = (bool)$request->status;
        $entreeSortie->id_projet = $request->id_projet;

        //$entreeSortie->projet()->sync($entreeSortie->id_projet);


        // Gérer le téléchargement et l'enregistrement du fichier s'il existe
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/EntreeSortieProjet'), $filename);
            $entreeSortie->file = $filename;
        }

        $nomEntreeSortie = $entreeSortie->nom;

        // Enregistrer l'objet dans la base de données
        $entreeSortie->save();

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
        $title = "Entrées/Sorties   -   WEB VISION  -  Gestion";


        // $categorie = Categorie::findOrFail($id);
        // $alldepenses = Categorie::all();
        $projet = Projet::findOrFail($id);
        $allprojets = Projet::all();
        //$nom = $projet->nom;
            //dd($depenses);
        // if ($categorie->count() > 0) {
        //     $entreesSorties = $categorie->entreesSorties;
        //     $totalEntrees = $entreesSorties->where('status', 0)->sum('montant');
        //     $totalSorties = $entreesSorties->where('status', 1)->sum('montant');
        //     $difference = $totalEntrees - $totalSorties;
        //     return view('pages.app.expenses.view_simpleExpenses', compact('projet', 'allprojets', 'categorie', 'alldepenses', 'totalEntrees', 'totalSorties', 'difference'))->with('title', $title);
        //}
        if ($projet->count() > 0) {
            $entreesSorties = $projet->entreesSorties;
            $totalEntrees = $entreesSorties->where('status', 0)->sum('montant');
            $totalSorties = $entreesSorties->where('status', 1)->sum('montant');
            $difference = $totalEntrees - $totalSorties;
            return view('pages.app.expenses.view_expenses', compact('projet', 'allprojets', 'totalEntrees', 'totalSorties', 'difference'))->with('title', $title);
        }


        return redirect()->back()->with('error', 'Projet ou catégorie non trouvé.');
    }


    public function showSimple ($categorie){
        $title = "Entrées/Sorties   -   WEB VISION  -  Gestion";

        $categorie = Categorie::findOrFail($categorie);
        $alldepenses = Categorie::all();
        if ($categorie->count() > 0) {
            $entreesSorties = $categorie->entreesSorties;
            $totalEntrees = $entreesSorties->where('status', 0)->sum('montant');
            $totalSorties = $entreesSorties->where('status', 1)->sum('montant');
            $difference = $totalEntrees - $totalSorties;
            return view('pages.app.expenses.view_simpleExpenses', compact('categorie', 'alldepenses', 'totalEntrees', 'totalSorties', 'difference'))->with('title', $title);
        }
        return redirect()->back()->with('error', 'Projet ou catégorie non trouvé.');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
            'file' => 'nullable|file|mimes:pdf,doc,docx', // Accepter uniquement les fichiers PDF, DOC et DOCX
            'id_projet' => 'required|exists:projets,id',
        ]);

        $entreeSortie = EntreeSortie::findOrFail($entreeSortie);

        $entreeSortie->nom = $data['nom'];
        $entreeSortie->description = $data['description'];
        $entreeSortie->montant = $data['montant'];
        $entreeSortie->status = (bool)$data['status'];
        $entreeSortie->id_projet = $data['id_projet'];

        if ($request->hasFile('file')) {
            // S'il y a un nouveau fichier téléchargé, supprimez l'ancien fichier s'il existe
            if ($entreeSortie->file) {
                $filePath = public_path('uploads') . '/' . $entreeSortie->file;
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            // Enregistrez le nouveau fichier téléchargé
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['file'] = $filename; // Mettez à jour le champ "file" dans la variable $data
        }

        $nomEntreeSortie = $entreeSortie->nom;

        $entreeSortie->fill($data)->save();
        session()->flash('success', 'L\'entrée/sortie "'.$nomEntreeSortie.'" a été mis à jour avec succès.');
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
        try {
            // Chercher le partenaire par son ID
            $entreeSortie = EntreeSortie::findOrFail($id);
            $entreeSortie->delete();
            if ($entreeSortie->file) {
                // Supprimer le fichier du système de fichiers
                $filePath = public_path('uploads/EntreeSortieProjet') . '/' . $entreeSortie->file;
                File::delete($filePath);
            }
            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }
    }


    public function update1(Request $request, $projets)
    {


        try {
            $data = $request->validate([
                'id_projet' => 'required|exists:projets,id',
            ]);

            $entreeSortie = EntreeSortie::findOrFail($projets);
            $entreeSortie->id_projet = $data['id_projet'];
            $entreeSortie->save();

            session()->flash('success', 'L\'entrée/sortie a été mise à jour avec succès.');
            return redirect()->back();
        } catch (\Exception $e) {
            // Gérer les erreurs ici, par exemple en affichant un message d'erreur dans le journal
            // ou en redirigeant l'utilisateur vers une page d'erreur personnalisée
            session()->flash('error', 'Une erreur s\'est produite lors de la mise à jour de l\'entrée/sortie.');
            return redirect()->back();
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

    public function Simpledestroy($id)
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
}
