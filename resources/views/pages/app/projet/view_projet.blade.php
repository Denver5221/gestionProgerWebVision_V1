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

        @vite(['resources/scss/light/assets/elements/custom-tree_view.scss', 'resources/scss/dark/assets/elements/custom-tree_view.scss'])
        @vite(['resources/scss/light/assets/components/accordions.scss'])
        @vite(['resources/scss/dark/assets/components/accordions.scss'])

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">


        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.js" integrity="sha512-YwbKCcfMdqB6NYfdzp1NtNcopsG84SxP8Wxk0FgUyTvgtQe0tQRRnnFOwK3xfnZ2XYls+rCfBrD0L2EqmSD2sA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.css" integrity="sha512-tlP4yGOtHdxdeW9/VptIsVMLtgnObNNr07KlHzK4B5zVUuzJ+9KrF86B/a7PJnzxEggPAMzoV/eOipZd8wWpag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>


    <!-- BREADCRUMB -->

    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="{{getRouterValue();}}/app/index">Liste des Catégories de Projets</a></li>
                <li class="breadcrumb-item"><a href="{{getRouterValue();}}/app/projet/1">Liste de Projets</a></li>
                <li class="breadcrumb-item active"><a href=""><b>Voir Projet</b></a></li>
            </ol>
        </nav>
    </div>


    <!-- Form Button trigger modal -->

        <!-- Modal -->


    <div class="row layout-top-spacing" id="cancel-row">
        <br>
        <div class="widget-content seperator-header text-center">

            <button class="btn btn-success mb-2 me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#createCategorieModal">Ajouter une Tâche</button>

        </div>
    </div>



  <!-- Categories Modal -->

    <div class="modal fade" id="createCategorieModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="createProjectModalLabel" style="color:black;">Ajouter une Tâche</h5>
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


                    <form action="{{ route('projet.ajoutertache', ['projet' => $projet->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div id="champs-container" class="row mb-2">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">
                                    <div class="col-md-12 mb-2">
                                        <div class="list-title" style="margin-top: -4%">
                                            <label for="nom">Nom <span style="color:red;">*</span> </label>
                                            <input name="nom" id="nom" type="text" placeholder="Nom du projet" class="form-control form-control-sm @error('nom') is-invalid @enderror" required>
                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="list-description">
                                            <label name="description" for="description">Description</label>
                                            <input name="description" id="description" type="text" placeholder="Description" class="form-control form-control-sm @error('description') is-invalid @enderror" required>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class=" ">
                                            <label for="s-delai">Délai <span style="color:red;">*</span> </label>
                                            <input name="delai" type="date" class="form-control form-control-sm" id="s-delai" placeholder="None">
                                        </div>
                                    </div>
                                    <div class="list-list-part">
                                        <label for="s-list-part">Priorité <span style="color:red;">*</span> </label>
                                        <select name="id_priorite" class="form-select form-select-sm @error('id_priorite') is-invalid @enderror" data-placeholder="Selectionner une priorité">
                                            <option disabled selected>Selectionner une priorité</option>
                                            @foreach ($priorites as $priorite)
                                                <option value="{{ $priorite->id }}">{{ $priorite->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_priorite')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="list-list-part">
                                        <label for="s-list-part">Participants <span style="color:red;">*</span> </label>
                                        <select name="id_participant[]" class="form-select form-select-sm @error('id_participant') is-invalid @enderror" id="multiple-select-custom-field" data-placeholder="Selectionner un ou plusieurs participant(s)" multiple data-mdb-visible-options="1">
                                            <option disabled>Selectionner un ou plusieurs participant(s)</option>
                                            @foreach ($participants as $participant)
                                                <option value="{{ $participant->id }}">{{ $participant->nom }} {{ $participant->prenom }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_participant')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                    {{-- <div class="col-md-12 ">
                                        <div class="multiple-file-upload">
                                            <label for="file">Fichier(s)</label>
                                            <input type="file" id="file" multiple name="file[]" class="form-control form-control-sm @error('file') is-invalid @enderror" required>
                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-danger " data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-sm btn-success widget-content icon-success" data-bs-dismiss="modal">Ajouter</button>
                        </div>
                    </form>
                </div>

                {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script> --}}
                <script>

                    $( '#multiple-select-custom-field' ).select2( {
                        theme: "bootstrap-5",
                        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                        placeholder: $( this ).data( 'placeholder' ),
                        closeOnSelect: false,
                        tags: true
                    } );
                </script>

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
                                <h4 style="color:black;">{{ $projet->nom }}</h4>
                            </div>
                        </div><br/>
                    </center>
                    <table id="style-3" class="table table-responsive style-3 dt-table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Participant(s)</th>
                                <th>fichier(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp
                            <tr>
                                <td>{{ $projet->nom }}</td>
                                <td>{{ $projet->description }}</td>
                                <td>
                                    @foreach ($projet->participants as $participant)
                                        {{ $participant->nom }} {{ $participant->prenom }}<br/>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @if($projet->file)
                                        @php
                                            $filePaths = json_decode($projet->file);
                                        @endphp
                                        @if(count($filePaths) > 0)
                                            @foreach($filePaths as $filePath)
                                                <a href="{{ asset('uploads/Projet/' . $filePath) }}" target="_blank">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a href="{{ asset('uploads/Projet/' . $filePath) }}" download>
                                                    <i class="las la-download"></i>
                                                </a>
                                                {{-- {{ basename($filePath) }}<br> <!-- Afficher le nom du fichier --> --}}
                                            @endforeach
                                        @else
                                            Aucun fichier
                                        @endif
                                    @else
                                        Aucun fichier
                                    @endif
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





    <div id="toggleAccordion" class="no-icons accordion">
        <center><br>
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 style="color:black;">Liste des tâches  </h4>
                </div>
            </div><br/>
        </center>


        @foreach ($taches as $tache)

        <!-- TACHE #2 -->
        <div class="card">
            <div class="card-header" id="...">
                <section class="row">
                    <div role="menu" class="collapsed col text-center" data-bs-toggle="collapse" data-bs-target="#defaultAccordionOne{{ $tache->id }}" aria-expanded="true" aria-controls="defaultAccordionOne">
                        <p>{{ $tache->nom }}</p>
                        <div class="task-body">

                            <div class="task-bottom">
                                <div class="tb-section-1">
                                    <span data-taskDate="28 Apr">Délai : {{ $tache->delai }} </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col text-center">
                        <p>{{ $tache->description }}</p>
                    </div>
                    <div class="col m-8  text-center">
                        <div class="add-s-task">
                            <a class="addTask  _effect--ripple waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#createSousTacheModal{{ $tache->id }}" data-tache-participants="{{ json_encode($tache->participants->pluck('id')) }}">
                                <svg style="color: #5cb85c" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line>
                                </svg>

                            </a>
                            <a href="#" class="addTask  _effect--ripple waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#viewTacheModal{{ $tache->id }}">
                                <svg style="color: #0275d8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path fill="#0275d8" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path fill="#0275d8" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </a>
                            {{-- <a href="{{ route('projet.destroy', ['id' => $tache->id]) }}" class="addTask  _effect--ripple waves-effect waves-light">
                                <svg style="color: red" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path fill="red" d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill="red" fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>

                            </a> --}}
                            <button style="font-size: 65%" class="delete-button btn btn-danger btn-sm _effect--ripple waves-effect waves-light warning confirm" data-delete-url="{{ route('tache.destroy', $tache->id) }}">Supprimer</button>
                        </div>
                    </div>
                </section>
            </div>

            <div id="defaultAccordionOne{{ $tache->id }}" class="collapse" aria-labelledby="..." data-bs-parent="#toggleAccordion">
                <div class="card-body">
                    <ul class="treeview" id="treeviewBasicCSSChild">
                        @foreach ($tache->sousTaches as $sousTache)
                        <li class="tv-item tv-folder">
                            <a data-bs-toggle="modal" data-bs-target="#viewSousTacheModal{{ $sousTache->id }}">
                                <div class="tv-header row" id="cssChildHeading{{ $sousTache->id }}">
                                    <div class="tv-collapsible collapsed col-6 " data-bs-toggle="collapse" data-bs-target="#cssChild{{ $sousTache->id }}" aria-expanded="false" aria-controls="cssChild{{ $sousTache->id }}">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <polyline points="9 6 15 12 9 18"></polyline>
                                            </svg>
                                        </div>
                                        <p class="title">{{ $sousTache->nom }}</p>
                                    </div>
                                    <div class="col-6 todo-item-inner">
                                        <div class="n-chk text-center" data-bs-toggle="collapse" data-bs-target>
                                            <i class="las la-hourglass-half"> <span>{{ $sousTache->delai }}</span></i>
                                        </div>
                                    </div>
                                </div>
                                <div id="cssChild{{ $sousTache->id }}" class="treeview-collapse collapse" aria-labelledby="cssChildHeading{{ $sousTache->id }}" data-bs-parent="#treeviewBasicCSSChild">
                                    <ul class="treeview" id="treeviewBasicModulesChild">
                                        <li class="tv-item">
                                            <p>Doit être fait par:
                                                @foreach ($sousTache->participants as $participant)
                                                    {{ $participant->nom }} {{ $participant->prenom }}{{ !$loop->last ? ', ' : '' }}
                                                @endforeach
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </li>



                        <div class="modal fade" id="viewSousTacheModal{{ $sousTache->id }}" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header justify-content-center text-center">
                                        <h5 class="modal-title" id="createProjectModalLabel" style="color:black;">Détails de la sous-tâche <b>{{ $sousTache->nom }}</b></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div id="champs-container" class="row mb-2">
                                                <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                                    <div class="widget-content widget-content-area blog-create-section ">
                                                        <div class="row mb-2">
                                                            <div class="">
                                                                <input type="text" class="form-control" id="floatingInput" value="Nom : {{ $sousTache->nom }}" readonly style="color:black;">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="">
                                                                <input type="text" class="form-control" id="floatingInput" value="Description : {{ $sousTache->description }}" readonly style="color:black;">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class=" ">
                                                                <input type="text" class="form-control" id="s-delai" value="Délai : {{ $sousTache->delai }}" readonly style="color:black;">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="">


                                                                <input type="text" class="form-control" id="s-delai" value="Participant(s) :@foreach ($sousTache->participants as $participant){{ $participant->nom }} {{ $participant->prenom }}{{ !$loop->last ? ', ' : '' }}@endforeach" readonly style="color:black;">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p>Fichiers annexes :</p>
                                                            <ul>
                                                                @php
                                                                    $fichiers = json_decode($sousTache->file, true);
                                                                @endphp

                                                                @foreach ($fichiers as $fichier)
                                                                    <li>
                                                                        <a href="{{ asset('uploads/Projet/Tache/' . $fichier) }}" target="_blank">{{ $fichier }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <small style="margin-left: 5%;"> <strong style="font-size: 150%;">{{ count($fichiers) }}</strong> fichier(s) disponible(s)</small>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-info" data-bs-dismiss="modal"><span class="btn-text-inner">Quitter</span></button>
                                    </div>

                                </div>
                            </div>
                        </div>






                        @endforeach
                    </ul>
                </div>
            </div>

        </div>



            {{-- Modal add Sous-Tache --}}
        <div class="modal fade" id="createSousTacheModal{{ $tache->id }}" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center text-center">
                        <h5 class="modal-title" id="createProjectModalLabel" style="color:black;">Ajouter une Tâche</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('projet.ajouterSoustache', ['tache' => $tache->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div id="champs-container" class="row mb-2">
                                <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                    <div class="widget-content widget-content-area blog-create-section ">
                                        <div class="row mb-2">
                                            <div class="form-floating mb-3 ">
                                                <input name="nom" type="text" class="form-control" id="floatingInput" placeholder="Création de la vue Auth">
                                                <label style="responsive: true; margin-left:3%;" for="floatingInput">Nom <span style="color:red;">*</span> </label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="form-floating mb-3 ">
                                                <input name="description" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                                <label style="responsive: true; margin-left:3%;" for="floatingInput">Description</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class=" ">
                                                <label for="s-delai">Délai <span style="color:red;">*</span> </label>
                                                <input name="delai" type="date" class="form-control" id="s-delai" placeholder="None">
                                            </div>
                                        </div><div class="col-md-12 mb-2">
                                            <div class="list-list-part">
                                                <label for="s-list-part">Participants <span style="color:red;">*</span> </label>
                                                <select name="id_participant[]" class="form-select form-select-sm @error('id_participant') is-invalid @enderror" id="multiple-select-custom-field1" data-placeholder="Selectionner un ou plusieurs participant(s)" multiple>
                                                    <option disabled>Selectionner un ou plusieurs participant(s)</option>
                                                    @foreach ($tacheParticipants as $participant)
                                                        <option value="{{ $participant->id }}" {{ in_array($participant->id, old('id_participant', [])) ? 'selected' : '' }}>
                                                            {{ $participant->nom }} {{ $participant->prenom }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('id_participant')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="multiple-file-upload">
                                                <label for="file">Fichier(s)</label>
                                                <input type="file" id="file" multiple name="file[]" class="form-control @error('file') is-invalid @enderror" required>
                                                @error('file')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <input type="hidden" name="id_tache" value="{{ $tache->id }}">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-success mt-2 mb-2" data-bs-dismiss="modal">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="viewTacheModal{{ $tache->id }}" tabindex="-1" aria-labelledby="viewTacheModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewTacheModalLabel">Détails de la tâche {{ $tache->nom }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div id="champs-container" class="row mb-2">
                                <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                    <div class="widget-content widget-content-area blog-create-section ">
                                        <div class="row mb-2">
                                            <div class="">
                                                <input type="text" class="form-control" value="Nom: {{ $tache->nom }}" readonly style="color:black;">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="">
                                                <input type="text" class="form-control" value="Description: {{ $tache->description }}" readonly style="color:black;">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class=" ">
                                                <input type="text" class="form-control" value="Priorité: {{ $tache->priorite ? $tache->priorite->nom : 'Aucune priorité' }}" readonly style="color:black;">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class=" ">
                                                <input type="text" class="form-control" value="Délai: {{ $tache->delai }}" readonly style="color:black;">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="">
                                                <input type="text" class="form-control" value="Participants: @foreach ($tache->participants as $participant){{ $participant->nom }} {{ $participant->prenom }}{{ !$loop->last ? ', ' : '' }}@endforeach" readonly style="color:black;">
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 ">
                                            <p>Cliquez <a href="#">ICI</a> pour télécharger les fichiers annexes</p>
                                            <small style="margin-left: 5%;"> <strong style="font-size: 150%;">04</strong> fichiers disponibles</small>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>



        @endforeach


    </div>







<div class="mt-4 text-end" style="margin-left: 70%">
    {{ $taches->links() }}
</div>



        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
        <script>

            $( '#multiple-select-custom-field1' ).select2( {
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
                closeOnSelect: false,
                tags: true
            } );

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
                                            'Une erreur s\'est produite lors de la suppression du membre.',
                                            'error'
                                        );
                                    }
                                })
                                .catch(error => {
                                    console.log(error);
                                    Swal.fire(
                                        'Erreur',
                                        'Une erreur s\'est produite lors de la suppression du membre.',
                                        'error'
                                    );
                                });
                        }
                    });
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
