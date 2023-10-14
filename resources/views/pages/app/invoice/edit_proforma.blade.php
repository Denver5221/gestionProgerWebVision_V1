<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/flatpickr/flatpickr.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        
        @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/light/plugins/flatpickr/custom-flatpickr.scss'])
        @vite(['resources/scss/light/assets/apps/invoice-add.scss'])
        
        @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/dark/plugins/flatpickr/custom-flatpickr.scss'])
        @vite(['resources/scss/dark/assets/apps/invoice-add.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->


    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{getRouterValue();}}/app/invoice/list">Facturation</a></li>
                <li class="breadcrumb-item active" aria-current="page"><b>Édition</b></li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    
    <form action="{{ route('facture_def.update', $facture->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row invoice layout-top-spacing layout-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                <div class="doc-container">

                    <div class="row">
                        <div class="col-xl-9">

                            <div class="invoice-content">

                                <div class="invoice-detail-body">
                                    <div class="mb-4 text-center invoice-title">
                                        <h3>Informations Facture</h3>
                                    </div>

                                    <div class="invoice-detail-title">



                                        <div class="">

                                            <div class="row justify-content-around">

                                                <div class="col-6">

                                                    <div class="form-group ">
                                                        <label for="number">Numéro de facture <span style="color:red;">*</span> </label>
                                                        <input type="text" class="form-control form-control-sm" id="number" value="{{ $facture->NumeroFacture }}" placeholder="082/07/2023/WV" name="NumeroFacture" required>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="due">Date d'échéance <span style="color:red;">*</span> </label>
                                                        <input type="text" value="{{ $facture->date_echeant }}" class="form-control form-control-sm" id="due" placeholder="None" name="date_echeant" required>
                                                    </div>

                                                </div>

                                                <div class="col-6">

                                                    <div class="form-group ">
                                                        <label for="date"> Date de facturation <span style="color:red;">*</span> </label>
                                                        <input type="text" value="{{ $facture->date_facture }}" class="form-control form-control-sm" id="date" placeholder="Add date picker" name="date" required>
                                                    </div>
                                                        

                                                </div>
                                                <div class="col-6">

                                                    <div class="form-group ">
                                                        <label for="date"> Nom Taxe <span style="color:red;">*</span> </label>
                                                        <input type="text" value="{{ $facture->tax_nom }}" class="form-control form-control-sm" id="nom_taxe" placeholder="Add date picker" name="taxe" required>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="date"> Poucentage Taxe <span style="color:red;">*</span> </label>
                                                        <input type="text" value="{{ $facture->tax_percent }}" class="form-control form-control-sm" id="percent" placeholder="Add date picker" name="pourcentage" required>
                                                    </div>
                                                        
                                                </div>

                                                <div class="col-md-4">


                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="invoice-detail-terms">

                                        <div class="row justify-content-between">

                                            <div class="mb-4 text-center invoice-title">
                                                <h3>Informations du Client</h3>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="mb-4 form-group">
                                                    <label for="name"> Nom de l'entreprise <span style="color:red;">*</span> </label>
                                                    <input type="text" value="{{ $facture->client->nom_client }}" class="form-control form-control-sm" id="name" placeholder="Nom" name="nom_client" required>
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <label for="name"> N° RCCM </label>
                                                    <input type="number" value="{{ $facture->client->rccm}}" class="form-control form-control-sm" id="name" placeholder="RCCM" name="rccm">
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <label for="name"> N° IFU </label>
                                                    <input type="number" value="{{ $facture->client->ifu }}" class="form-control form-control-sm" id="name" placeholder="IFU" name="ifu">
                                                </div>
                                                <div class="mb-4 form-group">
                                                    <label for="name"> Addresse </label>
                                                    <input type="text" value="{{ $facture->client->addresse }}" class="form-control form-control-sm" id="name" placeholder="Addresse" name="addresse">
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="objet">Objet de la facture <span style="color:red;">*</span> </label>
                                                    <input type="text" value="{{ $facture->Objet }}" class="form-control form-control-sm" id="objet" placeholder="Objet" name="Objet" required>
                                                </div>
                                                <br>
                                                <div class="mb-4 form-group">
                                                    <label for="name"> Telephone </label>
                                                    <input type="tel" value="{{ $facture->client->telephone }}" class="form-control form-control-sm" id="name" placeholder="Tel..." name="telephone">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="invoice-detail-items">
                                        <div class="table-responsive">
                                            <table id="item-table" class="table item-table">
                                                <thead>
                                                    <tr>
                                                        <th class=""></th>
                                                        <th>Désignation</th>
                                                        <th class="">Prix Unitaire</th>
                                                        <th class="">Quantité</th>
                                                        <th class="text-right">Total</th>
                                                    </tr>
                                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                                </thead>
                                                <tbody id="table-body">
                                                    @if ($facture->details->isNotEmpty())
                                                        
                                                    @foreach ($facture->details as $data )
                                                        
                                            
                                                    <tr>
                                                        <td class="delete-item-row">
                                                            <ul class="table-controls">
                                                                <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" title="Delete" onclick="supprimerChamp(this)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
                                                            </ul>
                                                        </td>
                                                        <td class="description">
                                                            <input type="text" class="form-control form-control-sm" value="{{ $data->designation }}" placeholder="Désignation item" name="designation[]">
                                                            <textarea class="form-control"  placeholder="Autres détails" name="details[]">{{ $data->details }}</textarea>
                                                        </td>
                                                        <td class="rate">
                                                            <input type="number" value="{{ $data->prix_unitaire }}" class="form-control form-control-sm" placeholder="Prix" name="prix_unitaire[]" oninput="calculerTotal(this)">
                                                        </td>
                                                        <td class="text-right qty">
                                                            <input type="number" value="{{ $data->quantite }}" class="form-control form-control-sm" placeholder="Quantité" name="quantite[]" oninput="calculerTotal(this)">
                                                        </td>
                                                        <td class="text-right amount">
                                                            <span class="editable-amount">
                                                                <span class="amount">0</span>
                                                                <input type="hidden" value="{{ $data->total}}" name="total[]" value="0"> <!-- Champ pour le total -->
                                                            </span>
                                                        </td>
                                                    </tr>
                                                      @endforeach
                                                      @endif

                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="button" onclick="clonerChamp()" class="btn btn-info">Ajouter</button>

                                        <script>
                                            function clonerChamp() {
                                                var tableBody = document.getElementById('table-body');
                                                var rowToClone = tableBody.querySelector('tr');
                                                var newRow = rowToClone.cloneNode(true);
                                                tableBody.appendChild(newRow);
                                                enableDeleteButtons();
                                            }

                                            function supprimerChamp(button) {
                                                var rowToDelete = button.closest('tr');
                                                if (rowToDelete && rowToDelete.parentNode) {
                                                    if (rowToDelete.parentNode.childElementCount > 1) {
                                                        rowToDelete.parentNode.removeChild(rowToDelete);
                                                        enableDeleteButtons();
                                                    }
                                                }
                                            }

                                            function enableDeleteButtons() {
                                                var deleteButtons = document.querySelectorAll('.delete-item');
                                                deleteButtons.forEach(function(button, index) {
                                                    button.disabled = index === 0;
                                                });
                                            }

                                            function calculerTotal(input) {
                                                var row = input.closest('tr');
                                                var prixUnitaire = row.querySelector('.rate input').value;
                                                var quantite = row.querySelector('.qty input').value;
                                                var total = prixUnitaire * quantite;
                                                var totalField = row.querySelector('.amount .amount');
                                                var totalInputField = row.querySelector('input[name="total[]"]'); // Champ de formulaire pour le total
                                                totalField.textContent = total.toFixed(2);
                                                totalInputField.value = total.toFixed(2); // Mise à jour de la valeur du champ caché
                                            }
                                        </script>
                                    </div>




                                    <!-- <div class="invoice-detail-note">

                                        <div class="row">

                                            <div class="col-md-12 align-self-center">

                                                <div class="form-group row invoice-note">
                                                    <label for="invoice-detail-notes" class="col-sm-12 col-form-label col-form-label-sm">Notes:</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" id="invoice-detail-notes" placeholder='Notes - For example, "Thank you for doing business with us"' style="height: 88px;"></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div> -->


                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3">
                            <div class="invoice-actions-btn">

                                <div class="mb-2 row">
                                    <div class="col-sm-12">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="nom_categorie">
                                            <option value="{{ $facture->id_category  }}">{{ $facture->category->nom }}</option>
                                            @if ($categorie->isNotEmpty())
                                            @foreach ($categorie as $data)


                                            <option value="{{ $data->id }}">{{ $data->nom }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-12">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected disabled>Sélectionner le projet</option>
                                            @if ($projets->isNotEmpty())
                                            @foreach ($projets as $projet)


                                            <option value="{{ $projet->id }}">{{ $projet->nom }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>


                                <div class="invoice-action-btn">

                                    <div class="row" style="margin-left:15%;">
                                            <div class="">
                                                <a href="{{getRouterValue();}}/app/invoice/preview" class=""><button type="button" class="mt-2 mb-2 btn btn-secondary ">Prévisualiser</button></a>
                                            </div>
                                            <div class="">
                                                <a href="javascript:void(0);"><button type="submit" class="btn btn-success btn-edit widget-content {{-- icon-success mt-2 mb-2 --}} " data-bs-dismiss="modal">Enregistrer</button></a>
                                            </div>

                                           
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>

            </div>
        </div>
    </form>
    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/filepond/filepond.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImagePreview.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageCrop.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageResize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageTransform.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
        <script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
        @vite(['resources/assets/js/apps/invoice-add.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>