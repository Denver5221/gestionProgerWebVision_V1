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
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{getRouterValue();}}/app/invoice/list">Facturation</a></li>
                <li class="breadcrumb-item active"><a href="{{getRouterValue();}}/app/invoice/add_proforma">Ajout Facture Proforma</a></li>
                <li class="breadcrumb-item active" aria-current="page"><b>Voir</b></li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    
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

                                                    <div class="col-sm-6 col-12 mr-auto">
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
                                                <br><br>

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
                                                        <h5 class="" style="font-weight: 900; font-size:150%;">ILLIMITIS BURKINA</h5>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-around">
                                                    <div class="col-2">
                                                        <h5 class="text-decoration-underline" style="font-weight: 900;"> Objet :</h5>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="">Prise de Phot/Reportage Vidéo; FORMATION INFOGRAPHIE et MARKETONG DIGITAL</h5>
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
                                                            <tr>
                                                                <td>Calendar App Customization</td>
                                                                <td class="text-end">25000 F</td>
                                                                <td class="text-end">1</td>
                                                                <td class="text-end">25000 F</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Chat App Customization</td>
                                                                <td class="text-end">25000 F</td>
                                                                <td class="text-end">1</td>
                                                                <td class="text-end">25000 F</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Laravel Integration</td>
                                                                <td class="text-end">25000 F</td>
                                                                <td class="text-end">1</td>
                                                                <td class="text-end">25000 F</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Backend UI Design</td>
                                                                <td class="text-end">35000 F</td>
                                                                <td class="text-end">1</td>
                                                                <td class="text-end">35000 F</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="text-center" style="font-weight: 900;">TOTAL</td>
                                                                <td class="text-end">110000 F</td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                    </table><br>
                                                    <table class="table table-bordered ">
                                                        <tr>
                                                            <td colspan="3" class="text-center" style="font-weight: 900;background-color:#120A8F; color:white; ">TOTAL HT</td>
                                                            <td class="text-end">110000 F</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-center" style="font-weight: 900;background-color:#120A8F; color:white; ">TVA</td>
                                                            <td class="text-end">110000 F</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-center" style="font-weight: 900;background-color:#120A8F; color:white; ">TOTAL TTC</td>
                                                            <td class="text-end">110000 F</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            

                                            <div class="inv--note">

                                                <div class="row mt-4">
                                                    <div class="col-sm-12 col-12 order-sm-0 order-1">
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
                                        <a href="javascript:void(0);" class="btn btn-secondary btn-print  action-print">Imprimer</a>
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

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        @vite(['resources/assets/js/apps/invoice-preview.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>