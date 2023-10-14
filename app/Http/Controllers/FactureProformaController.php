<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\DetailFacture;
use App\Models\Facture;
use App\Models\InfoClient;
use App\Models\InfoFacture;
use App\Models\Projet;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FactureProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $categorie = Categorie::all();
            $projets =Projet::all();
             return view('pages.app.invoice.add_proforma', ['projets'=>$projets,'categorie'=>$categorie,'title' => 'Invoice Add | CORK - Multipurpose Bootstrap Dashboard Template ', 'breadcrumb' => 'This Breadcrumb']);

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
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
        try {

            $request->validate([
                'NumeroFacture' => 'required|string',
                'date_echeant' => 'date',
                'date' => 'date',
                'taxe' => 'string',
                'pourcentage' => 'numeric',
                'nom_client' => 'required|string',
                'rccm' => 'string|nullable',
                'ifu' => 'string|nullable',
                'addresse' => 'string',
                'Objet' => 'required|string',
                'telephone' => 'string',
                'designation' => 'array',
                'details' => 'array',
                'prix_unitaire' => 'array',
                'quantite' => 'array',
                'total' => 'array',
                'nom_categorie' => 'required|integer',
            ]);
            DB::beginTransaction();
        
            // Créer le client s'il n'existe pas ou le récupérer s'il existe déjà
           // Créer le client s'il n'existe pas ou le récupérer s'il existe déjà
            $infoClient = InfoClient::firstOrCreate([
                'nom_client' => $request->input('nom_client'),
            ], [
                'rccm' => $request->input('rccm'),
                'ifu' => $request->input('ifu'),
                'addresse' => $request->input('addresse'),
                'telephone' => $request->input('telephone'),
            ]);
        
            $infoClient->save();
        
            // Créer la facture
            $facture = new Facture([
                'NumeroFacture' => $request->input('NumeroFacture'),
                'Objet' => $request->input('Objet'),
                'date_echeant' => $request->input('date_echeant'),
                'date_facture' => $request->input('date'),
                'type' => 2,
                'tax_nom' => $request->input('taxe'),
                'tax_percent' => $request->input('pourcentage'),
                'id_client' => $infoClient->id,
                'id_user' => auth()->user()->id, // Assurez-vous d'avoir le système d'authentification en place
                'id_category' => $request->input('nom_categorie'),
            ]);
            $facture->save();
        
            // Créer les détails de la facture
            $designations = $request->input('designation');
            $details = $request->input('details');
            $prixUnitaires = $request->input('prix_unitaire');
            $quantites = $request->input('quantite');
            $totals = $request->input('total');
        
            foreach ($designations as $key => $designation) {
                DetailFacture::create([
                    'id_facture' => $facture->id,
                    'designation' => $designation,
                    'details' => $details[$key],
                    'prix_unitaire' => $prixUnitaires[$key],
                    'quantite' => $quantites[$key],
                    'total' => $totals[$key],
                ]);
            }
            DB::commit();
        
            session()->flash('success', 'Facture créée avec succès');
        
            return view('pages.app.invoice.preview', ['facture'=>$facture,'infoClient'=>$infoClient ,'title' => 'Invoice Preview | CORK - Multipurpose Bootstrap Dashboard Template ', 'breadcrumb' => 'This Breadcrumb']);
        
        
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
        try{
            $categorie = Categorie::all();
            $projets = Projet::all();
            $facture =Facture::findOrFail($id);
            return view('pages.app.invoice.edit_proforma', ['projets'=>$projets,'categorie'=>$categorie,'facture'=>$facture,'title' => 'Invoice Edit | CORK - Multipurpose Bootstrap Dashboard Template ', 'breadcrumb' => 'This Breadcrumb']);
        
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Une erreur s\'est produite Veuillez réessayer plus tard ou contacter l\'assistance.'])->withInput();
        }
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
        try {
            $request->validate([
                'NumeroFacture' => 'required|string',
                'date_echeant' => 'date',
                'date' => 'date',
                'taxe' => 'string',
                'pourcentage' => 'numeric',
                'nom_client' => 'required|string',
                'rccm' => 'string|nullable',
                'ifu' => 'string|nullable',
                'addresse' => 'string',
                'Objet' => 'required|string',
                'telephone' => 'string',
                'designation' => 'array',
                'details' => 'array',
                'prix_unitaire' => 'array',
                'quantite' => 'array',
                'total' => 'array',
                'nom_categorie' => 'required|integer',
            ]);
        
            DB::beginTransaction();
        
            
                // Récupérer la facture à mettre à jour
                $facture = Facture::findOrFail($id);
        
                // Mettre à jour les données de la facture
                $facture->NumeroFacture = $request->input('NumeroFacture');
                $facture->date_echeant = $request->input('date_echeant');
                $facture->date_facture = $request->input('date');
                $facture->tax_nom = $request->input('taxe');
                $facture->tax_percent = $request->input('pourcentage');
                $facture->Objet = $request->input('Objet');
                $facture->id_category = $request->input('nom_categorie');
        
                // Récupérer le client associé à la facture
                $infoClient = InfoClient::firstOrCreate([
                    'nom_client' => $request->input('nom_client'),
                ], [
                    'rccm' => $request->input('rccm'),
                    'ifu' => $request->input('ifu'),
                    'addresse' => $request->input('addresse'),
                    'telephone' => $request->input('telephone'),
                ]);
                
                // Assurez-vous d'attribuer le nouvel ID du client à la facture
                $facture->id_client = $infoClient->id;
        
                // Supprimer les anciens détails de la facture
                $facture->details()->delete();
        
                // Créer les nouveaux détails de la facture
                $designations = $request->input('designation');
                $details = $request->input('details');
                $prixUnitaires = $request->input('prix_unitaire');
                $quantites = $request->input('quantite');
                $totals = $request->input('total');
            
                foreach ($designations as $key => $designation) {
                    DetailFacture::create([
                        'id_facture' => $facture->id,
                        'designation' => $designation,
                        'details' => $details[$key],
                        'prix_unitaire' => $prixUnitaires[$key],
                        'quantite' => $quantites[$key],
                        'total' => $totals[$key],
                    ]);
                }
        
                $facture->save();
        
                DB::commit();
        
                session()->flash('success', 'Facture mise à jour avec succès');
        
                return view('pages.app.invoice.preview', [
                    'facture' => $facture,
                    'infoClient' => $infoClient,
                    'title' => 'Invoice Preview | CORK - Multipurpose Bootstrap Dashboard Template ',
                    'breadcrumb' => 'This Breadcrumb'
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                DB::rollBack();
                $errors = $e->errors();
                $errorsString = '';
        
                foreach ($errors as $fieldErrors) {
                    $errorsString .= implode(', ', $fieldErrors) . ', ';
                }
        
                $errorsString = rtrim($errorsString, ','); // Supprimer la virgule finale s'il y en a une
        
                session()->flash('error', 'Une erreur s\'est produite lors de la mise à jour : ' . $errorsString);
        
                return redirect()->back()->withErrors($errors)->withInput();
            } catch (QueryException $e) {
                // Gérer les erreurs de base de données
                // ...
                // Loguer l'erreur
                Log::error($e->getMessage());
        
                session()->flash('error', 'Une erreur s\'est produite lors de la mise à jour. Veuillez réessayer plus tard ou contacter l\'assistance.');
                return redirect()->back();
            } catch (\Exception $e) {
                // Gérer d'autres types d'erreurs
                // ...
        
                session()->flash('error', 'Une erreur s\'est produite lors de la mise à jour');
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
           
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // En cas d'erreur, renvoyer une réponse JSON avec l'erreur
            return response()->json(['success' => false, 'error' => 'Veuillez réessayer plus tard ou contacter l\'assistance.']);
        }
    }
}
