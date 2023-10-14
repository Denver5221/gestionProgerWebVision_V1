<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class FactureAncieneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request);
        try{
            $request->validate([
                'numero_facture' => 'required|string',
                'objet' => 'required|string',
                'montant' => 'numeric',
                'file' => 'required|',
             ]);
    
            // Enregistrer la facture dans la base de données (vous devez créer un modèle Facture pour cela)
            $facture = new Facture();
            $facture->NumeroFacture = $request->input('numero_facture');
            $facture->Objet = $request->input('objet');
            $facture->id_category  = $request->input('nom_categorie');
            $facture->type = 3;
            $facture->montant = $request->input('montant');
            
            if ($request->hasFile('file')) {
                $cheminFile = Str::slug($facture->Objet . ' ' . time());
                $fichier = $request->file('file');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();

                    $fichier->move(public_path('storage/dossier_file'), $nomFichierAvecExtension);

                    $facture->file = 'dossier_file/'. $nomFichierAvecExtension;
            }
            $facture->save();

            session()->flash('success', 'Facture créée avec succès');

            return redirect()->back();

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
             $errors = $e->errors();
             $errorsString = '';
             foreach ($errors as $fieldErrors) {
                 $errorsString .= implode(', ', $fieldErrors) . ', ';
             }
        
             $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une
        
             session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout: ' . $errorsString);
        
             return redirect()->back()->withErrors($errors)->withInput();
        
            } catch (QueryException $e) {
                // Gérer les erreurs de base de données
                // ...
                // Loguer l'erreur
                Log::error($e->getMessage());
        
                session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout . Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...
        
                session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            }
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
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'numero_facture' => 'required|string',
                'objet' => 'required|string',
                'montant' => 'numeric',
             ]);
    
            // Enregistrer la facture dans la base de données (vous devez créer un modèle Facture pour cela)
            $facture = Facture::findOrFail($id);
            $facture->NumeroFacture = $request->input('numero_facture');
            $facture->Objet = $request->input('objet');
            $facture->id_category  = $request->input('nom_categorie');
            $facture->type = 3;
            $facture->montant = $request->input('montant');

            
            if ($request->hasFile('file')) {
                if ($facture->file) {
                    $file = public_path($facture->file);
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }

                $cheminFile = Str::slug($facture->Objet . ' ' . time());
                $fichier = $request->file('file');
                $nomFichierAvecExtension = $cheminFile . '.' . $fichier->getClientOriginalExtension();

                    $fichier->move(public_path('storage/dossier_file'), $nomFichierAvecExtension);

                    $facture->file = 'dossier_file/'. $nomFichierAvecExtension;
            }
            $facture->save();

            session()->flash('success', 'Facture créée avec succès');

            return redirect()->back();

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
             $errors = $e->errors();
             $errorsString = '';
             foreach ($errors as $fieldErrors) {
                 $errorsString .= implode(', ', $fieldErrors) . ', ';
             }
        
             $errorsString = rtrim($errorsString, ', '); // Supprimer la virgule finale s'il y en a une
        
             session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout: ' . $errorsString);
        
             return redirect()->back()->withErrors($errors)->withInput();
        
            } catch (QueryException $e) {
                // Gérer les erreurs de base de données
                // ...
                // Loguer l'erreur
                Log::error($e->getMessage());
        
                session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout . Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...
        
                session()->flash('error', 'Une erreur s\'est produite lors de l\'ajout. Veuillez réessayer plus tard ou contacter l\'assistance.');
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
            // Chercher le partenaire par son ID
            $data = Facture::findOrFail($id);

            // Supprimer le partenaire
            $data->delete();
            $file = public_path('storage/' .$data->file);
            if (file_exists($file)) {
                unlink($file);
            }
           
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }
    }
}
