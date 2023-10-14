<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/table/datatable/datatables.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalerts2/sweetalerts2.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/light/assets/apps/invoice-list.scss'])
        @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/custom_dt_miscellaneous.scss'])
        @vite(['resources/scss/light/assets/components/modal.scss'])
        @vite(['resources/scss/light/assets/apps/notes.scss'])
        @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])
        <link rel="stylesheet" href="{{asset('plugins/table/datatable/datatables.css')}}">
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/custom_dt_miscellaneous.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/custom_dt_miscellaneous.scss'])

        <!--  END CUSTOM STYLE FILE  -->
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->


    <!-- BREADCRUMB -->

    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href=""><b>Facturation</b></a></li>
            </ol>
        </nav>
    </div>


    <div class="row layout-top-spacing" id="cancel-row">
        <br>
        <div class="text-center widget-content seperator-header">
            <a href="{{getRouterValue();}}/app/invoice/add"><button class="mb-2 btn btn-success me-8 btn-lg">Ajouter une facture définitive</button></a>
            <a href="{{getRouterValue();}}/app/invoice/add_proforma"><button class="mb-2 btn btn-success me-8 btn-lg">Ajouter une facture proforma</button></a>
            <button class="mb-2 btn btn-success me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#createOldFactModal">Ajouter une ancienne facture</button>
        </div>
    </div>
    @if(session()->has('success') )
    <div class="modal-body">
        @if(session()->has('success') || session()->has('error'))
            <script>
                function showAlert(icon, title, text) {
                    Swal.fire({
                        icon: icon,
                        title: title,
                        text: text
                    });
                }

                @if(session()->has('success'))
                    showAlert('success', 'Succès', '{{ session("success") }}');
                @endif

                @if(session()->has('error'))
                    showAlert('error', 'Erreur', '{{ session("error") }}');
                @endif
            </script>
        @endif
    </div>
@endif

    <!-- Ancienne facture Modal -->

    <div class="modal fade" id="createOldFactModal" tabindex="-1" aria-labelledby="createOldFactModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="text-center modal-header justify-content-center">
                    <h5 class="modal-title" id="createOldFactModal">Ajouter une Ancienne Facture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('facture_anciene.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div id="champs-container" class="mb-2 row">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">
                                    <div class="mb-2 row">
                                        <div class="form-floating">
                                            <input type="text" name="numero_facture" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                            <label style="responsive: true; margin-left:3%;"  for="floatingInput">N°Facture</label>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="form-floating">
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="nom_categorie">
                                                <option selected disabled>Categorie</option>
                                                @if ($categorie->isNotEmpty())
                                                @foreach ($categorie as $data)
                                                <option value="{{ $data->id }}">{{ $data->nom }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="form-floating">
                                            <input type="text" name="objet" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                            <label style="responsive: true; margin-left:3%;" for="floatingInput">Objet de la facture</label>
                                        </div>
                                    </div>
                                    <div class="mb-2 row">
                                        <div class="form-floating">
                                            <input type="number" name="montant" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                            <label style="responsive: true; margin-left:3%;" for="floatingInput">Montant</label>
                                        </div>
                                    </div>
                                    <div class="mt-2 row">
                                        <div class="mt-2 ">
                                            <label style="responsive: true; margin-left:1%;" for="floatingInput">Importer la facture</label>
                                            <input type="file" name="file" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="mt-2 mb-2 btn btn-success widget-content icon-success" data-bs-dismiss="modal">Ajouter</button>
                        </div>
        
                    </form>
                </div>
              
                

            </div>
        </div>
    </div>

    
    <div class="row" id="cancel-row">
                    
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing">
            <div class="widget-content widget-content-area br-8">


                <table id="invoice-list" class="table dt-table-hover" style="width:100%">
                    <center><br>
                        <div class="row"></div>
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste des Factures Définitives</h4>
                            </div>                 
                        </div>
                    </center>
                    <thead>
                        <tr>
                            <th>N°Facture</th>
                            <th>Client</th>
                            <th>Objet</th>
                            <th>Taxe</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @if ($facture->isNotEmpty())
                        @php
                            $total =0;
                        @endphp
                            @foreach ($facture as $data)
                            @if ($data->type == 1)
                                @php
                                    $total = 0;

                                    foreach ($data->details as $detail) {
                                        $total += $detail->total;
                                    }
                                @endphp
                         
                        <tr>
                            <td><a href="{{getRouterValue();}}/app/invoice/preview"><span class="inv-number">{{ $data->NumeroFacture }}</span></a></td>
                            <td>
                                <div class="d-flex">
                                    
                                    <p class="mb-0 align-self-center user-name"> {{ $data->client->nom_client }}</p>
                                </div>
                            </td>
                            <td><span class=""> {{ $data->Objet }}</span></td>
                            <td><span class="">{{ $data->tax_nom }} : {{ $data->tax_percent }}%</span></td>
                            <td><span class="inv-amount">{{ $data->created_at->format('d M, Y ') }}</span></td>
                            <td>{{ $total }}F</td>
                            <td>
                            <div class="gap-2 d-grid d-md-block">
                                    <a href="{{route('facture_def.show' , $data->id)}}"> <button class="btn btn-info btn-sm _effect--ripple waves-effect waves-light" type="button">Voir</button></a>
                                    <a href="{{ route('facture_def.edite', $data->id) }}"> <button class="btn btn-warning btn-sm _effect--ripple waves-effect waves-light" type="button">Éditer</button></a>
                                    <a href="{{ route('facture_avances.show', $data->id) }}"> <button class="btn btn-success btn-sm _effect--ripple waves-effect waves-light" type="button">Avances</button></a>
                                    <button class="delete-button btn btn-danger widget-content warning confirm" data-delete-url="{{ route('facture_def.destroy', $data->id) }}" >Supprimer</button>
                                    {{-- <button class="delete-button dropdown-item widget-content warning confirm" data-delete-url="{{ route('facture_def.destroy', $data->id) }}">Supprimer</button> --}}

                                </div>
                            </td>
                        </tr>

                        @endif
                                
                        @endforeach
                    @endif
                       
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        
                        <table class="table multi-table dt-table-hover" style="width:100%">
                                   <center><br>
                        <div class="row"></div>
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste des Factures Proforma</h4>
                            </div>                 
                        </div>
                    </center>
                            <thead>
                                <tr>
                                    <th>N°Facture</th>
                                    <th>Client</th>
                                    <th>Objet</th>
                                    <th>Taxe</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($facture->isNotEmpty())
                                @php
                                    $total =0;
                                @endphp
                                    @foreach ($facture as $data)
                                    @if ($data->type == 2)
                                        @php
                                            $total = 0;
        
                                            foreach ($data->details as $detail) {
                                                $total += $detail->total;
                                            }
                                        @endphp
                                 
                                <tr>
                                    <td><a href="{{getRouterValue();}}/app/invoice/preview"><span class="inv-number">{{ $data->NumeroFacture }}</span></a></td>
                                    <td>
                                        <div class="d-flex">
                                            
                                            <p class="mb-0 align-self-center user-name"> {{ $data->client->nom_client }}</p>
                                        </div>
                                    </td>
                                    <td><span class=""> {{ $data->Objet }}</span></td>
                                    <td><span class="">{{ $data->tax_nom }} : {{ $data->tax_percent }}%</span></td>
                                    <td><span class="inv-amount">{{ $data->created_at->format('d M, Y ') }}</span></td>
                                    <td>{{ $total }}F</td>
                                    <td>
                                    <div class="gap-2 d-grid d-md-block">
                                            <a href="{{route('facture_def.show' , $data->id)}}"> <button class="btn btn-info btn-sm _effect--ripple waves-effect waves-light" type="button">Voir</button></a>
                                            <a href="{{ route('facture_proforma.edite', $data->id) }}"> <button class="btn btn-warning btn-sm _effect--ripple waves-effect waves-light" type="button">Éditer</button></a>
                                            <button class="delete-button btn btn-danger widget-content warning confirm" data-delete-url="{{ route('facture_proforma.destroy', $data->id) }}" >Supprimer</button>
                                            {{-- <button class="delete-button dropdown-item widget-content warning confirm" data-delete-url="{{ route('facture_def.destroy', $data->id) }}">Supprimer</button> --}}
        
                                        </div>
                                    </td>
                                </tr>
        
                                @endif
                                        
                                @endforeach
                            @endif
                               
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Salary</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <table id="style-2" class="table style-2 dt-table-hover">
                            <thead>
                                <tr>
                                    <th>N°Facture</th>
                                    <th>Categorie</th>
                                    <th>Objet</th>
                                    <th>Montant</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($facture->isNotEmpty())
                                @foreach ($facture as $data )
                                    @if ($data->type == 3)
                                        
                                    
                                <tr>
                                    <td><a href="javascript:void(0);"><span class="inv-number">{{ $data->NumeroFacture }}</span></a></td>
                                    <td>
                                            <p class="mb-0 align-self-center user-name"> {{ $data->category->nom }} </p>
                                            
                                    </td>
                                    <td><span class=""> {{ $data->Objet }}</span></td>
                                    <td><span class="">{{ $data->montant }}</span></td>
                                    <td>
                                    <div class="gap-2 d-grid d-md-block">
                                            <a href="{{ asset('storage/'.$data->file) }}"> <button class="btn btn-info btn-sm _effect--ripple waves-effect waves-light" type="button">Télécharger</button></a>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#inputFormModal{{ $data->id }}"> <button class="btn btn-warning btn-sm _effect--ripple waves-effect waves-light" type="button">Modifier</button></a>
                                            <button class="delete-button btn btn-danger widget-content warning confirm" data-delete-url="{{ route('facture_anciene.delete', $data->id) }}" >Supprimer</button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="inputFormModal{{ $data->id }}" tabindex="-1" aria-labelledby="inputFormModal{{ $data->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">

                                        <div class="modal-header" id="inputFormModal{{ $data->id }}Label">
                                            <h5 class="modal-title">Modifier un <b>organismes</b></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('facture_anciene.update', $data->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div id="champs-container" class="mb-2 row">
                                                    <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                                        <div class="widget-content widget-content-area blog-create-section ">
                                                            <div class="mb-2 row">
                                                                <div class="form-floating">
                                                                    <input type="text" value="{{ $data->NumeroFacture }}" name="numero_facture" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                                                    <label style="responsive: true; margin-left:3%;"  for="floatingInput">N°Facture</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="form-floating">
                                                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="nom_categorie">
                                                                        
                                                                            <option value="{{ $data->id_category  }}">{{ $data->category->nom }}</option>
                                                                       
                                                                        @if ($categorie->isNotEmpty())
                                                                        @foreach ($categorie as $data3)
                                                                        <option value="{{ $data3->id }}">{{ $data3->nom }}</option>
                                                                        @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="form-floating">
                                                                    <input type="text"  value="{{ $data->Objet }}" name="objet" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                                                    <label style="responsive: true; margin-left:3%;" for="floatingInput">Objet de la facture</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                <div class="form-floating">
                                                                    <input type="number" value="{{ $data->montant }}" name="montant" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                                                    <label style="responsive: true; margin-left:3%;" for="floatingInput">Montant</label>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 row">
                                                                <div class="mt-2 ">
                                                                    <label style="responsive: true; margin-left:1%;" for="floatingInput">Importer la facture</label>
                                                                    <input type="file" name="file" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                                                </div>
                                                                <div class="mt-2 ">
                                                                    <a href="{{ asset('storage/'.$data->file) }}">File existant Voir ICI</a>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="mt-2 mb-2 btn btn-success widget-content icon-success" data-bs-dismiss="modal">Ajouter</button>
                                                </div>
                                
                                            </form>

                                        </div>

                                        </div>
                                    </div>
                                </div>
                                
                                @endif
                                @endforeach                                    
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        



    </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>

        <!-- Script pour la suppression du partenaire -->
        <script>
            // Sélectionner tous les boutons de suppression
            const deleteButtons = document.querySelectorAll('.delete-button');

            // Ajouter un gestionnaire d'événement à chaque bouton de suppression
            deleteButtons.forEach((button) => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Récupérer l'URL de suppression à partir de l'attribut data
                    const deleteUrl = button.dataset.deleteUrl;

                    // Afficher la boîte de dialogue de confirmation
                    Swal.fire({
                        title: 'Êtes-vous sûr(e) ?',
                        text: 'Cette suppression est irréversible !',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, Supprimer !'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Envoyer une requête AJAX pour supprimer le partenaire
                            axios.delete(deleteUrl)
                                .then(response => {
                                    if (response.data.success) {
                                        Swal.fire(
                                            'Supprimé !',
                                            'membre supprimé avec succès.',
                                            'success'
                                        ).then(() => {
                                            // Recharger la page après la suppression
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire(
                                            'Erreur',
                                            'Une erreur s\'est produite lors de la suppression de la facture.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    console.log(error);
                                    Swal.fire(
                                        'Erreur',
                                        'Une erreur s\'est produite lors de la suppression de la facture',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });
        </script>



        <script>
            // var e;
            
    
            var c3 = $('#style-3').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "order": [[ 1, "asc" ]],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Page N° _PAGE_ sur _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Rechercher...",
                   "sLengthMenu": "Trier par :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10
            });
    
            multiCheck(c4);

        </script>

        <script>
            
            var c4 = $('#style-4').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "order": [[ 1, "asc" ]],
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Page N° _PAGE_ sur _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Rechercher...",
                   "sLengthMenu": "Trier par :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 10
            });
    
            multiCheck(c4);
            
        </script>



    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/custom-sweetalert.js')}}"></script>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        @vite(['resources/assets/js/custom.js'])
        <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
        @vite(['resources/assets/js/apps/invoice-list.js'])

        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        @vite(['resources/assets/js/custom.js'])
        <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/custom_miscellaneous.js')}}"></script>
   
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>