<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tache;
use App\Models\Projet;
use App\Models\Priorite;
// use Illuminate\Http\UploadedFile;
use App\Models\Categorie;
use App\Models\SousTache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjetController extends Controller
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
        $categories = Categorie::all();
        $priorites = Priorite::all();
        $title = "Projets  -   WEB VISION  -  Gestion";

        return view('pages.app.projet.index', compact('categories', 'title', 'priorites'));
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
        //dd($request->all());
        try {
            $data = $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
                'delai' => 'required|date',
                'id_participant' => 'required|array',
                'id_participant.*' => 'exists:users,id',
                'id_categorie' => 'exists:categories,id',
                'file' => 'required|array',
                'file.*' => 'required|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png|max:10240', // Taille maximale : 10MB
            ]);
            // dd($request->$id_participant);
            //dd($data);
            $projet = new Projet();

            $projet->nom = $request->nom;
            $projet->description = $request->description;
            $projet->delai = $request->delai;
            $projet->id_categorie = $request->id_categorie;
             //dd($request->file);
            //dd($id_participants = json_decode($request->id_participant, true));

            //  dd($projet);
            $fileData = $request->file('file');
            $filePaths = [];
            // $data = json_decode($request->file('file')[0], true);
            // dd($data);
            foreach ($fileData as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/Projet/'), $filename);
                $filePaths[] = $filename;
            }
            $projet->file = json_encode($filePaths);

            //dd($file);

            //dd($projet);
            foreach ($request->id_participant as $data) {
                $id = User::findOrFail($data);
                //dd($id);
                $projet->participants()->attach($projet->id, ['id_user' => $id->id]);
            }

            //dd($projet);
            $projet->save();

            $nomProjet = $projet->nom;

            session()->flash('success', 'L\'entrée/sortie "'.$nomProjet.'" a été ajouté avec succès.');
            return redirect()->back();
        } catch (ValidationException $e) {
            //dd($e->getMessage());
            session()->flash('error', 'Une erreur est survenue lors de l\'enregistrement du projet. Veuillez corriger les erreurs dans le formulaire.');

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            //dd($e->getMessage());
            session()->flash('error', 'Une erreur est survenue lors de l\'enregistrement du projet. Veuillez réessayer plus tard.');

            return redirect()->back(); // Redirigez l'utilisateur vers le formulaire avec un message d'erreur
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categorieId)
    {
        $categorie = Categorie::with('projets')->findOrFail($categorieId);
        $categories = Categorie::all();
        $projet = Projet::with('participants')->find($categorieId);
        $users = User::all();
        // Vous pouvez maintenant utiliser $categorie pour personnaliser le contenu de la page
        $title = "Projets  -   WEB VISION  -  Gestion";

        return view('pages.app.projet.projet', compact('categories', 'categorie', 'projet', 'users'))->with('title', $title);
    }


    public function view(Projet $projet)
    {
// N'oublie pas de regler le problème de participants au niveau de la sous-tache
        $users = User::all();
        $priorites = Priorite::all();
        $participants = $projet->participants;
        $taches = $projet->taches->sortByDesc('updated_at');

        // Récupérer la dernière tâche pour afficher les sous-tâches
        $tache = $taches->first();
        $tacheParticipants = $tache->participants ?? 0;

        // Paginer les tâches manuellement avec LengthAwarePaginator
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 2; // Nombre d'éléments par page
        $currentPageItems = $taches->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $taches = new LengthAwarePaginator($currentPageItems, count($taches), $perPage, $currentPage);

        $taches->withPath('/modern-light-menu/app/projet/view/2');

        $title = "Projets  -   WEB VISION  -  Gestion";

        return view('pages.app.projet.view_projet', compact('projet', 'priorites', 'participants', 'taches', 'users', 'tacheParticipants'))->with('title', $title);
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
    public function update(Request $request, Projet $projet)
    {
        try {
            $data = $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
                'delai' => 'required|date',
                'id_participant' => 'required|array',
                'id_participant.*' => 'exists:users,id',
                'file' => 'nullable|array',
                'file.*' => 'mimes:pdf,doc,docx,txt,jpg,jpeg,png|max:10240', // Taille maximale : 10MB
            ]);

            $projet->nom = $data['nom'];
            $projet->description = $data['description'];
            $projet->delai = $data['delai'];


            $fileData = $request->file('file');
            $filePaths = [];
            // $data = json_decode($request->file('file')[0], true);
            // dd($data);
            foreach ($fileData as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/Projet/'), $filename);
                $filePaths[] = $filename;
            }
            $projet->file = json_encode($filePaths);

            $projet->save();

            foreach ($request->id_participant as $data) {
                $id = User::findOrFail($data);
                //dd($id);
                $projet->participants()->attach($projet->id, ['id_user' => $id->id]);
            }

            session()->flash('success', 'Le projet "'.$projet->nom.'" a été mis à jour avec succès.');
            return redirect()->back();
        } catch (ValidationException $e) {
            //dd($e->getMessage());
            session()->flash('error', 'Une erreur est survenue lors de l\'enregistrement du projet. Veuillez corriger les erreurs dans le formulaire.');

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            session()->flash('error', 'Une erreur est survenue lors de la mise à jour du projet. Veuillez réessayer plus tard.');
            return redirect()->back();
        }
    }


    public function ajouterTache(Request $request, $projet)
    {
        try {
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
                'delai' => 'required|date',
                'id_priorite' => 'required|exists:priorites,id',
                'id_participant' => 'required|array',
                'id_participant.*' => 'exists:users,id',
                // 'file' => 'required|array',
                // 'file.*' => 'required|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png|max:10240',
            ]);
            //dd($validatedData);

            // Créez une nouvelle instance de Tache
            $tache = new Tache([
                'nom' => $request->nom,
                'description' => $request->description,
                'delai' => $request->delai,
                'id_priorite' => (int)$request->id_priorite,
                // Ajoutez d'autres attributs de la tâche si nécessaire
            ]);
            //dd($tache);

            // Associez la tâche au projet en utilisant la relation définie dans les modèles
            $projet = Projet::findOrFail($projet);
            // $fileData = $request->file('file');
            // $filePaths = [];
            // // $data = json_decode($request->file('file')[0], true);
            // // dd($data);
            // foreach ($fileData as $file) {
            //     $filename = time() . '_' . $file->getClientOriginalName();
            //     $file->move(public_path('uploads/Projet/Tache/'), $filename);
            //     $filePaths[] = $filename;
            // }
            // $tache->file = json_encode($filePaths);
            $projet->taches()->save($tache);

            foreach ($request->id_participant as $data) {
                $user = User::findOrFail($data);
                $tache->participants()->attach($user, ['id_projet' => $projet->id, 'id_priorite' => $request->id_priorite]);
            }

                //dd($tache);

            session()->flash('success', 'La tâche "'.$tache->nom.'" a été ajouté avec succès.');
            return redirect()->back();
        } catch (ValidationException $e) {
            //dd($e->getMessage());
            session()->flash('error', 'Une erreur est survenue lors de l\'enregistrement du projet. Veuillez corriger les erreurs dans le formulaire.');

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            session()->flash('error', 'Une erreur est survenue lors de la mise à jour du projet. Veuillez réessayer plus tard.');
            return redirect()->back();
        }
    }


    public function afficherTaches($idProjet)
    {
        $projet = Projet::findOrFail($idProjet);
        $users = User::all();
        $taches = $projet->taches;
        //dd($taches);

        return view('pages.app.projet.view_projet', compact('projet', 'taches', 'users'));
    }



    public function ajouterSousTache(Request $request, $tache)
    {
        try {
            // Valider les données du formulaire de création de sous-tâche
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
                'delai' => 'required|date',
                'id_participant' => 'required|array',
                'id_participant.*' => 'exists:users,id',
                'file' => 'required|array',
                'file.*' => 'required|file|mimes:pdf,doc,docx,txt,jpg,jpeg,png|max:10240',
            ]);


            //dd($validatedData);

            // Créer la sous-tâche
            $sousTache = new SousTache([
                'nom' => $request->nom,
                'description' => $request->description,
                'delai' => $request->delai,
                'id_tache' => $request->id_tache,
            ]);

            // Enregistrer la sous-tâche
            $tache = Tache::findOrFail($tache);

            $fileData = $request->file('file');
            $filePaths = [];
            // $data = json_decode($request->file('file')[0], true);
            // dd($data);
            foreach ($fileData as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/Projet/Tache/'), $filename);
                $filePaths[] = $filename;
            }
            $sousTache->file = json_encode($filePaths);

            $tache->sousTaches()->save($sousTache);


            foreach ($request->id_participant as $data) {
                $user = User::findOrFail($data);
                $sousTache->participants()->attach($user, ['id_soustache' => $sousTache->id]);
            }
            //dd($sousTache);

            // Rediriger vers la page de la tâche parente avec un message de succès
            session()->flash('success', 'La sous-tâche "'.$sousTache->nom.'" a été ajouté avec succès.');
            return redirect()->back();
        } catch (ValidationException $e) {
            //dd($e->getMessage());
            session()->flash('error', 'Une erreur est survenue lors de l\'enregistrement du projet. Veuillez corriger les erreurs dans le formulaire.');

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            session()->flash('error', 'Une erreur est survenue lors de la mise à jour du projet. Veuillez réessayer plus tard.');
            return redirect()->back();
        }
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
        $tache = Tache::with('sousTaches')->findOrFail($id);

        $tache->sousTaches()->delete();

        // foreach ($tache->sousTaches as $sousTache) {
        //     $filePaths = $sousTache->file;

        //     foreach ($filePaths as $filePath) {
        //     $fullPath = public_path('uploads/Projet/Tache/' . $filePath);

        //     if (file_exists($fullPath)) {
        //         \File::delete($fullPath);
        //     }
        //     }
        // }

        $tache->delete();

        //session()->flash('success', 'La tâche et ses sous-tâches ont été supprimées avec succès.');
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Gérer les erreurs en cas d'échec
        //session()->flash('error', 'Une erreur est survenue lors de la suppression de la tâche.');
        return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
    }
}

}
