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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>


    <!-- BREADCRUMB -->

    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href=""><b>Postes</b></a></li>
            </ol>
        </nav>
    </div>

    <!-- Form Button trigger modal -->

        <!-- Modal -->


    <div class="row layout-top-spacing" id="cancel-row">
        <br>
        <div class="widget-content seperator-header text-center">
            {{-- <button class="btn btn-success mb-2 me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#createpostModal">Ajouter un Poste</button> --}}
            <!-- <a href="{{getRouterValue();}}/app/categorie"><button class="btn btn-success mb-2 me-8 btn-lg">Ajouter une Categorie</button></a>
            <button class="btn btn-success mb-2 me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#createDepenseModal">Ajouter une dépense simple</button> -->
            <!-- ... -->
        </div>
    </div>


    <!--    /**
            * =================================
            *    @Modal -  Role create, view and Edit
            *       Début
            * =================================
            */
    -->

    <!-- Role create Modal -->
    <div class="modal fade" id="createpostModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="createProjectModalLabel"><b>Ajouter un Poste</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                @if (session()->has('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                text: 'Succès',
                                title: '{{ session("success") }}',
                            });
                        </script>
                    @endif
                    @if (session()->has('error'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                text: 'Erreur',
                                title: '{{ session("error") }}',
                            });
                        </script>
                    @endif


                    <form action="{{ route('postes.store') }}" method="POST">
                        @csrf

                        <div id="champs-container" class="row mb-2">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="text" name="nom" class="form-control form-control-sm" placeholder="Nom">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="text" name="description" class="form-control form-control-lg" placeholder="Description">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success mt-2 mb-2">Ajouter</button>
                        </div>
                    </form>
                </div>

                <script>
                    document.querySelector('.widget-content.icon-success').addEventListener('click', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Poste ajoutée avec succès',
                        });
                    });
                </script>

            </div>
        </div>
    </div>


    <!-- Role view Modal -->
        @foreach ($postes as $poste)
    <div class="modal fade" id="viewpostModal{{ $poste->id }}" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="createProjectModalLabel">Poste <strong>{{ $poste->nom }}</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div id="champs-container" class="row mb-2">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input style="color: black;" type="text" name="nom" class="form-control" placeholder="Nom" value="{{ $poste->nom }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input style="color: black;" type="text" name="description" class="form-control" placeholder="Description" value="{{ $poste->description }}" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-info " data-bs-dismiss="modal">Quittez</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach


    <!-- Post Modal Edit -->
        @foreach ($postes as $poste)
    <div class="modal fade" id="editpostModal{{ $poste->id }}" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="createProjectModalLabel">Éditer le poste <b>{{ $poste->nom }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('postes.update', $poste->id) }}" method="POST">
                        @csrf
                        @method('PUT')


                        <div id="champs-container" class="row mb-2">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="text" name="nom" class="form-control form-control-sm" value="{{ $poste->nom }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success mt-2 mb-2">Éditer</button>
                        </div>
                    </form>
                </div>

                <script>
                    document.querySelector('.widget-content.icon-success').addEventListener('click', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Poste édité avec succès',
                        });
                    });
                </script>

            </div>
        </div>
    </div>
@endforeach


    <!--    /**
            * ==================================================
            *    @Modal -  Expenses Project and Simple, Category
            *       Fin
            * ==================================================
            */
    -->



    <!--    /**
            * =========================================
            *    @Tables -  Expenses Project and Simple
            *       Début
            * =========================================
            */
    -->


    <!-- Lié aux Projets -->

    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <center><br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste des Postes</h4>
                            </div>
                        </div>
                    </center>
                    @if ($postes->isEmpty())
                        <p>Aucun poste n'a été trouvé.</p>
                    @else
                    <table id="style-4" class="table style-4 dt-table-hover table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">N°</th>
                                <th class="text-center">Nom</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @php $counter = 1; @endphp
                            @foreach ($postes as $poste)

                            <tr>
                                <td class="checkbox-column text-center"> {{$counter}} </td>
                                <td>{{ $poste->nom }}</td>
                                <td class="text-center">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button data-bs-toggle="modal" data-bs-target="#viewpostModal{{ $poste->id }}" class="btn btn-info btn-sm _effect--ripple waves-effect waves-light" type="button">Voir</button>
                                        <button data-bs-toggle="modal" data-bs-target="#editpostModal{{ $poste->id }}" class="btn btn-warning btn-sm _effect--ripple waves-effect waves-light" type="button">Éditer</button>
                                        <form action="{{ route('postes.destroy', $poste->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm _effect--ripple waves-effect waves-light" type="submit">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- <tr>
                                <td class="checkbox-column text-center"> 2 </td>
                                <td>Info </td>
                                <td>Infographe </td>
                                <td class="text-center">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button data-bs-toggle="modal" data-bs-target="#viewpostModal" class="btn btn-info btn-sm _effect--ripple waves-effect waves-light" type="button">Voir</button>
                                        <button data-bs-toggle="modal" data-bs-target="#editpostModal" class="btn btn-warning btn-sm _effect--ripple waves-effect waves-light" type="button">Éditer</button>
                                        <button class="btn btn-danger btn-sm _effect--ripple waves-effect waves-light delete-button" type="button">Supprimer</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="checkbox-column text-center"> 3 </td>
                                <td>Community </td>
                                <td>Community manager </td>
                                <td class="text-center">
                                    <div class="d-grid gap-2 d-md-block">
                                        <button data-bs-toggle="modal" data-bs-target="#viewpostModal" class="btn btn-info btn-sm _effect--ripple waves-effect waves-light" type="button">Voir</button>
                                        <button data-bs-toggle="modal" data-bs-target="#editpostModal" class="btn btn-warning btn-sm _effect--ripple waves-effect waves-light" type="button">Éditer</button>
                                        <button class="btn btn-danger btn-sm _effect--ripple waves-effect waves-light delete-button" type="button">Supprimer</button>
                                    </div>
                                </td>
                            </tr> -->

                            @php $counter++; @endphp

                            @endforeach
                        </tbody>
                    </table>
                    @endif

                </div>
            </div>
        </div>
    </div>



        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
        <script>
            const deleteButtons = document.querySelectorAll('.delete-button');
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
                                'Poste supprimé avec success.',
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
