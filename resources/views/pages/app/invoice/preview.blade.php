<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/light/assets/apps/invoice-preview.scss'])
        @vite(['resources/scss/dark/assets/apps/invoice-preview.scss'])
        <!--  END CUSTOM STYLE FILE  -->

        

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BREADCRUMB -->
    @if ($facture->type == 1)

    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{getRouterValue();}}/app/invoice/list">Facturation</a></li>
                <li class="breadcrumb-item active"><a href="{{getRouterValue();}}/app/invoice/add">Ajout Facture Définitive</a></li>
                <li class="breadcrumb-item active" aria-current="page"><b>Voir</b></li>
            </ol>
        </nav>
    </div>
    @elseif ($facture->type == 2)
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{getRouterValue();}}/app/invoice/list">Facturation</a></li>
                <li class="breadcrumb-item active"><a href="{{getRouterValue();}}/app/invoice/add_proforma">Ajout Facture Proforma</a></li>
                <li class="breadcrumb-item active" aria-current="page"><b>Voir</b></li>
            </ol>
        </nav>
    </div>
    @endif
    <!-- /BREADCRUMB -->
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
    
    <div class="row invoice layout-top-spacing layout-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            
            <div class="doc-container">

                <div class="row">

                    <div class="col-xl-9">

                        <div class="invoice-container">
                            <div class="invoice-inbox">
                                
                                <div id="ct" class="">
                                    
                                    <div class="invoice-00001">
                                        <div class="content-section">

                                            <div class="inv--head-section inv--detail-section">
                                            
                                                <div class="row">

                                                    <div class="mr-auto col-sm-6 col-12">
                                                        <div class="d-flex">
                                                            <img class="company-logo" src="{{Vite::asset('resources/images/webvision.png')}}" alt="company">
                                                            <div class="justify-content-between ">
                                                                <h2 class="in-heading">WEB VISION</h2>
                                                                <h5 class="">Entreprise Digitale</h5>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                                                                                
                                                </div>

                                                <div class="row">
                                                    <span class="col-6 text-divider">FACTURE</span>
                                                </div>
                                                <div class="">
                                                    <h5 class="texte">Facture N° {{ $facture->NumeroFacture }}</h5>
                                                </div>

                                                <style>
                                                    .text-divider {
                                                    display: flex;
                                                    align-items: center;
                                                    margin-right: 200px;
                                                    width:100%;
                                                    color:black;
                                                    font-size:350%;
                                                    font-weight: 900;
                                                    }

                                                    .text-divider::before,
                                                    .text-divider::after {
                                                    content: '';
                                                    height: 50px;
                                                    background-color: #120A8F;
                                                    flex-grow: 1;
                                                    }

                                                    .text-divider::before {
                                                        width: 90%; /* Longueur du séparateur à gauche */
                                                    }

                                                    .text-divider::after {
                                                        width: 10%; /* Longueur du séparateur à droite */
                                                    }
                                                    h5.texte{
                                                        margin-left: 62%;
                                                    }
                                                </style>



                                                <div class="row justify-content-around">
                                                    <div class="col-2">
                                                        <h5 class="text-decoration-underline" style="font: size 140%;"> Doit :</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="" style="font-weight: 900; font-size:150%;">{{ $facture->client->nom_client }}</h5>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-around">
                                                    <div class="col-2">
                                                        <h5 class="text-decoration-underline" style="font-weight: 900;"> Objet :</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="">{{ $facture->Objet }}</h5>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            

                                            <div class="">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered ">
                                                        <thead class="" style="background-color:#120A8F; color:white; font-size:110%;">
                                                            <tr>
                                                                <th scope="col">Désignation</th>
                                                                <th class="text-end" scope="col">Prix Unitaire</th>
                                                                <th class="text-end" scope="col">Quantité</th>
                                                                <th class="text-end" scope="col">Prix Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $totalHT = 0;
                                                                $totalTVA = 0;
                                                                $totalTTC = 0;
                                                            @endphp
                                                           
                                                            @foreach ($facture->details as $detail)
                                                                <tr>
                                                                    <td>{{ $detail->designation }}</td>
                                                                    <td class="text-end">{{ $detail->prix_unitaire }} F</td>
                                                                    <td class="text-end">{{ $detail->quantite }}</td>
                                                                    <td class="text-end">{{ $detail->total }} F</td>
                                                                </tr>

                                                                @php
                                                                    $totalHT += $detail->total; // Additionnez le total de chaque détail
                                                                @endphp
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="3" class="text-center" style="font-weight: 900;">TOTAL</td>
                                                                <td class="text-end">{{ $totalHT  }} F</td>
                                                            </tr>
                                                        </tbody>
                                                            @php
                                                                // Calculez la TVA (supposons que la TVA soit de 20%)
                                                                $totalTVA = $totalHT * 0.2;
                                                                $totalTTC = $totalHT - $totalTVA;
                                                            @endphp
        
                                                    </table><br>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td colspan="3" class="text-center" style="font-weight: 900; background-color:#120A8F; color:white; ">TOTAL HT</td>
                                                            <td class="text-end">{{ number_format($totalHT, 2) }} F</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-center" style="font-weight: 900; background-color:#120A8F; color:white; ">TVA (20%)</td>
                                                            <td class="text-end">{{ number_format($totalTVA, 2) }} F</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-center" style="font-weight: 900; background-color:#120A8F; color:white; ">TOTAL TTC</td>
                                                            <td class="text-end">{{ number_format($totalTTC, 2) }} F</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="inv--note">

                                                <div class="mt-4 row">
                                                    <div class="order-1 col-sm-12 col-12 order-sm-0">
                                                        <p>Note: Thank you for doing Business with us.</p>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div> 
                                    
                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="col-xl-3">

                        <div class="invoice-actions-btn">

                            <div class="invoice-action-btn">

                                <div class="row">
                                <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-secondary btn-print action-print">Imprimer</a>
                                    </div>
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-info btn-download">Télécharger</a>
                                    </div>
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-success btn-edit widget-content icon-success">Sauvegarder</a>
                                    </div>

                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
                                    <script>
                                        document.querySelector('.widget-content.icon-success').addEventListener('click', function() {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Facture ajouté avec succès',
                                            });
                                        });

                                    </script>
                                </div>

                            </div>
                            
                        </div>
                        
                    </div>

                </div>
                
            </div>

        </div>
    </div>
    @if ($facture->type == 1)
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
                    @php
                       $factureAvance = App\Models\Facture::all();
                    @endphp
                    @if ($factureAvance->isNotEmpty())
                    @php
                        $total =0;
                    @endphp
                        @foreach ($factureAvance as $data)
                        @if ($data->type == 4)
                        @if ($data->id_facture == $facture->id)
                            
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
                                <a href="{{ route('facture_avances.edite', $data->id) }}"> <button class="btn btn-warning btn-sm _effect--ripple waves-effect waves-light" type="button">Éditer</button></a>
                                {{-- <a href="{{ route('facture_avances.show', $data->id) }}"> <button class="btn btn-success btn-sm _effect--ripple waves-effect waves-light" type="button">Avances</button></a> --}}
                                <button class="delete-button btn btn-danger widget-content warning confirm" data-delete-url="{{ route('facture_def.destroy', $data->id) }}" >Supprimer</button>
                                {{-- <button class="delete-button dropdown-item widget-content warning confirm" data-delete-url="{{ route('facture_def.destroy', $data->id) }}">Supprimer</button> --}}

                            </div>
                        </td>
                    </tr>
                    @endif

                    @endif
                            
                    @endforeach
                @endif
                   
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/custom-sweetalert.js')}}"></script>
        @vite(['resources/assets/js/apps/invoice-preview.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>