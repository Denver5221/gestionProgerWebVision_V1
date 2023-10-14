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
        @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/custom_dt_miscellaneous.scss'])
        @vite(['resources/scss/light/assets/components/modal.scss'])
        @vite(['resources/scss/light/assets/apps/notes.scss'])
        @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>


    <!-- BREADCRUMB -->

    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="">Forum</a></li>
            </ol>
        </nav>
    </div>

    <!-- /BREADCRUMB -->

    <div class="row layout-top-spacing" id="cancel-row">
        <br>
        <div class=" widget-content seperator-header text-center">
            <a href="{{getRouterValue();}}/forum/ajouter"> <button class="btn btn-success mb-2 me-8 btn-lg" >Poser une question</button></a>
            <a href="{{getRouterValue();}}/forum/categorie"><button class="btn btn-success mb-2 me-8 btn-lg">Categorie</button></a>     
            <a href="{{getRouterValue();}}/forum/spams"><button class="btn btn-success mb-2 me-8 btn-lg">Spams</button></a>     
            <a href="{{getRouterValue();}}/forum/utilisateurs"><button class="btn btn-success mb-2 me-8 btn-lg">Utilisateurs</button></a>     
        </div>

    </div>



    


    

    <!-- Form Button trigger modal -->

        <!-- Modal -->




                        
    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <center><br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste des posts du forum</h4>
                            </div>                 
                        </div>
                    </center>
                    <table id="style-3" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom & Prénom</th>
                                <th>Posts</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="checkbox-column text-center"> 1 </td>
                                <td>Derme Fadil </td>
                                <td>Comment faire des </td>
                                <td class="text-center">22/01/23</td>
                                <td class="text-center"><span class="shadow-none badge badge-success">Actif</span></td>
                                <td class="text-center">
                                    <div>
                                        <a href=""><button class="btn btn-danger btn-sm _effect--ripple waves-effect waves-light">Voir</button></a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="checkbox-column text-center"> 2 </td>
                                <td>Derme Fadil </td>
                                <td>Pourquoi faire des </td>
                                <td class="text-center">19/01/23</td>
                                <td class="text-center"><span class="shadow-none badge badge-warning">Inactif</span></td>
                                <td class="text-center">
                                    <div>
                                        <a href=""><button class="btn btn-danger btn-sm _effect--ripple waves-effect waves-light">Voir</button></a>
                                    </div>
                                </td>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <center><br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste de mes posts du forum</h4>
                            </div>                 
                        </div>
                    </center>
                    <table id="style-4" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Posts</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="checkbox-column text-center"> 1 </td>
                                <td>Comment faire des </td>
                                <td class="text-center">22/01/23</td>
                                <td class="text-center"><span class="shadow-none badge badge-success">Actif</span></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <a class="dropdown-item" href="javascript:void(0);">Voir</a>
                                            <a class="dropdown-item" href="{{getRouterValue();}}/forum/modifier"  >Modifier</a>
                                            <a class="dropdown-item widget-content warning confirm" href="javascript:void(0);">Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="checkbox-column text-center"> 2 </td>
                                <td>Pourquoi faire des </td>
                                <td class="text-center">19/01/23</td>
                                <td class="text-center"><span class="shadow-none badge badge-warning">Inactif</span></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                            <a class="dropdown-item" href="javascript:void(0);">Voir</a>
                                            <a class="dropdown-item" href="{{getRouterValue();}}/forum/modifier" >Modifier</a>
                                            <a class="dropdown-item widget-content warning confirm" href="javascript:void(0);">Supprimer</a>
                                        </div>
                                    </div>
                                </td>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>



        


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
        <script>
            const deleteButtons = document.querySelectorAll('.widget-content.warning.confirm');
            deleteButtons.forEach((button) => {
                button.addEventListener('click', function() {
                    Swal.fire({
                        title: 'êtes vous sure?',
                        text: "Cette suppression est irréversible!!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, Supprimer!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Supprimer!',
                                'Post forum supprimer avec success.',
                                'success'
                            )
                        }
                    })
                });
            });
        </script>




    
    <x-slot:footerFiles>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/custom-sweetalert.js')}}"></script>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        @vite(['resources/assets/js/custom.js'])

        <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/custom_miscellaneous.js')}}"></script>

        <script src="{{asset('plugins/filepond/filepond.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImagePreview.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageCrop.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageResize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageTransform.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/custom-filepond.js')}}"></script>

        <script>
            // var e;
            
    
            c3 = $('#style-3').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
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
            
            c4 = $('#style-4').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
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
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>