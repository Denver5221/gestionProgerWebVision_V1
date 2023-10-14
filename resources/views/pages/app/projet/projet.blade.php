<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}}
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/light/assets/components/modal.scss'])
        @vite(['resources/scss/light/assets/apps/scrumboard.scss'])

        @vite(['resources/scss/dark/assets/components/modal.scss'])
        @vite(['resources/scss/dark/assets/apps/scrumboard.scss'])
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])

        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script> --}}

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">



        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->


    <x-slot:scrollspyConfig>
        data-bs-spy="scroll" data-bs-target="#navSection" data-bs-offset="100"
    </x-slot>


     <!-- BREADCRUMB -->
     <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('projet.index')}}">Liste des Catégories de Projets</a></li>
                    <li class="breadcrumb-item active"><a href=""><b>Voir Projet</b></a></li>
                </ol>
            </nav>
        </div>
        <!-- /BREADCRUMB -->


    <div class="action-btn layout-top-spacing mb-5" style="margin-left:40%;">
        <button data-bs-toggle="modal" data-bs-target="#addListModal" class="btn btn-success mb-2 me-8 btn-lg">Ajouter un Projet</button>
    </div>


                <!-- Ajouter une Tâche modal -->
    <!-- <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="add-task-title modal-title" id="addTaskModalTitleLabel1">Ajouter une tâche</h5>
                    <h5 class="edit-task-title modal-title" id="addTaskModalTitleLabel2">Éditer une tâche</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="compose-box">
                        <div class="compose-content" id="addTaskModalTitle">
                            <div class="addTaskAccordion" id="add_task_accordion">
                                <div class="task-content task-text-progress">
                                    <div id="collapseTwo" class="collapse show" data-parent="#add_task_accordion">
                                        <div class="task-content-body">
                                            <form action="javascript:void(0);">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="task-title mb-4">
                                                            <label for="s-task">Nom <span style="color:red;">*</span> </label>
                                                            <input id="s-task" type="text" placeholder="Tâche" class="form-control" name="task">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="task-badge mb-4">
                                                            <label for="s-text">Description </label>
                                                            <input id="s-text" placeholder="Description" class="form-control" name="taskText"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="task-badge mb-4">
                                                            <label for="s-delai">Délai <span style="color:red;">*</span> </label>
                                                            <input id="s-delai" type="date" placeholder="Délai" class="form-control" name="task">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="task-badge">
                                                            <label for="s-part">Participants <span style="color:red;">*</span> </label>
                                                            <select id="s-part" class="form-select" aria-label=".form-select-sm example">
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-bs-dismiss="modal"> <span class="btn-text-inner">Annuler</span></button>
                    <button data-btnfn="addTask" class="btn add-tsk btn-success">Ajouter</button>
                    <button data-btnfn="editTask" class="btn edit-tsk btn-success" style="display: none;">Enregistrer</button>
                </div>
            </div>
        </div>
    </div> -->


                <!-- Ajouter un projet Modal -->

    <div class="modal fade" id="addListModal" tabindex="-1" role="dialog" aria-labelledby="addListModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title add-list-title" id="addListModalTitleLabel1">Ajouter un projet</h5>
                    {{-- <h5 class="modal-title edit-list-title" id="addListModalTitleLabel2">Éditer un projet</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body" style="padding-bottom:1%">


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


                    <div class="compose-box">
                        <div class="compose-content" id="addListModalTitle">
                            <form action="{{ route('projet.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="list-title" style="margin-top: -4%">
                                            <label for="nom">Nom <span style="color:red;">*</span> </label>
                                            <input name="nom" id="nom" type="text" placeholder="Nom du projet" class="form-control @error('nom') is-invalid @enderror" required>
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
                                            <input name="description" id="description" type="text" placeholder="Description" class="form-control @error('description') is-invalid @enderror" required>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="list-delai">
                                            <label name="delai" for="delai">Délai <span style="color:red;">*</span> </label>
                                            <input id="delai" placeholder="None" name="delai" type="date" class="form-control @error('delai') is-invalid @enderror" required>
                                            @error('delai')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="list-list-part">
                                            <label for="s-list-part">Participants <span style="color:red;">*</span> </label>
                                            <select name="id_participant[]" class="form-select @error('id_participant') is-invalid @enderror" id="multiple-select-custom-field" data-placeholder="Selectionner un ou plusieurs participant(s)" multiple>
                                                <option disabled>Selectionner un ou plusieurs participant(s)</option>
                                                @if ($users->isEmpty())
                                                    <option value="" disabled>Aucun participant disponible</option>
                                                @else
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                                                @endforeach
                                                @endif
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

                                    <input type="hidden" name="id_categorie" value="{{ $categorie->id }}">


                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-bs-dismiss="modal"><span class="btn-text-inner">Annuler</span></button>
                                    <button type="submit" class="btn add-list btn-success">Ajouter</button>
                                    {{-- <button type="submit" data-btnfn="editTask" class="btn edit-tsk btn-success" style="display: none;">Enregistrer</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@foreach ($categorie->projets as $projet)

    <div class="modal fade" id="editProjectModal{{ $projet->id }}" tabindex="-1" role="dialog" aria-labelledby="editListModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title edit-list-title" id="editListModalTitleLabel">Éditer un projet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body" style="padding-bottom:1%">



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


                    <div class="compose-box">
                        <div class="compose-content" id="editListModalContent">
                            <form action="{{ route('projet.update', ['projet' => $projet->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-12 mb-2">
                                    <div class="list-title" style="margin-top: -4%">
                                        <label for="nom">Nom <span style="color:red;">*</span> </label>
                                        <input name="nom" id="nom" type="text" placeholder="Nom du projet" class="form-control form-control-sm @error('nom') is-invalid @enderror" required value="{{ $projet->nom }}">
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
                                        <input name="description" id="description" type="text" placeholder="Description" class="form-control form-control-sm @error('description') is-invalid @enderror" required value="{{ $projet->description }}">
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="list-delai">
                                        <label name="delai" for="delai">Délai <span style="color:red;">*</span> </label>
                                        <input id="delai" placeholder="None" name="delai" type="date" class="form-control form-control-sm @error('delai') is-invalid @enderror" required value="{{ $projet->delai }}">
                                        @error('delai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="list-list-part">
                                        <label for="s-list-part">Participants <span style="color:red;">*</span> </label>
                                        <select name="id_participant[]" class="form-select form-select-sm @error('id_participant') is-invalid @enderror" id="multiple-select-custom-field1" data-placeholder="Selectionner un ou plusieurs participant(s)" multiple>
                                            <option disabled>Selectionner un ou plusieurs participant(s)</option>
                                            @if ($users->isEmpty())
                                                <option value="" disabled>Aucun participant disponible</option>
                                            @else
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->prenom }}</option>
                                            @endforeach
                                            @endif
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
                                        <input type="file" id="file" multiple name="file[]" class="form-control form-control-sm @error('file') is-invalid @enderror" required>
                                        <span>
                                            @if($projet->file)
                                                {{ $projet->file }}
                                            @else
                                                Aucun fichier
                                            @endif
                                        </span>
                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-danger" data-bs-dismiss="modal"><span class="btn-text-inner">Annuler</span></button>
                                    <button type="submit" class="btn edit-list btn-success">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


{{-- @foreach ($users as $user)
<option value="{{ $user->id }}" @if (in_array($user->id, $projet->participants->pluck('id')->toArray())) selected @endif>{{ $user->nom }} {{ $user->prenom }}</option>
@endforeach --}}


    <!-- Modal -->
    <!-- <div class="modal fade" id="deleteConformation" tabindex="-1" role="dialog" aria-labelledby="deleteConformationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="deleteConformationLabel">
                <div class="modal-header">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </div>
                    <h5 class="modal-title" id="exampleModalLabel">Delete the task?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="">If you delete the task it will be gone forever. Are you sure you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" data-remove="task">Delete</button>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row scrumboard" id="cancel-row">
        <div class="col-lg-12 layout-spacing">
            <div class="task-list-section">
                @foreach ($categorie->projets as $projet)
                <div data-section="{{ 's-' . $loop->index }}" class="task-list-container" data-connect="sorting">
                    <div class="connect-sorting">
                        <div class="task-container-header">
                            <h6 class="s-heading" data-listTitle="{{ $projet->nom }}">{{ $projet->nom }}</h6>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right left" aria-labelledby="dropdownMenuLink-1">
                                    <a class="dropdown-item" href="{{ route('projet.view', ['projet' => $projet->id]) }}">Voir</a>
                                    <a class="dropdown-item list-edit1" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editProjectModal{{  $projet->id }}">Éditer</a>
                                    <a class="dropdown-item list-delete" href="javascript:void(0);">Supprimer</a>
                                </div>
                            </div>
                        </div>
                        <div class="connect-sorting-content" data-sortable="true">
                            <div data-draggable="true" class="card img-task">
                                <div class="card-body">
                                    <div class="task-header">
                                        <div class="">
                                            <h5>Description :</h5>
                                            <p class="m-2" data-listTitle="{{ $projet->description }}">{{ $projet->description }}</p>
                                        </div>
                                    </div>
                                    <div class="task-header">
                                        <div class="">
                                            <h5>Participants :</h5>
                                                @if ($projet->participants->isEmpty())
                                                    <p disabled>Aucun participant disponible</p>
                                                @else
                                                    @foreach ($projet->participants as $participant)
                                                        <p>{{ $participant->nom }} {{ $participant->prenom }}</p>
                                                    @endforeach
                                                @endif
                                        </div>
                                    </div>

                                    <div class="task-content">
                                        <div class="">
                                            <div class="progress br-30">
                                                <div class="progress-bar bg-success" role="progressbar" data-progressState="20" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="task-body">
                                        <div class="task-bottom">
                                            <div class="tb-section-1">
                                                <span data-taskDate="28 Apr"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> 28 Apr </span>
                                            </div>
                                            <div class="tb-section-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 list-edit"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 list-delete"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <script>
        $( '#multiple-select-custom-field1' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            tags: true
        } );
        $( '#multiple-select-custom-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            tags: true
        } );

        $(document).ready(function () {
            $('.list-edit1').on('click', function () {
                var projectId = $(this).data('project-id');

                // Ici, vous pouvez charger les données du projet à partir de l'API ou de votre backend
                // et remplir le contenu du modal avec ces données

                // Ouvrir le modal
                $('#editListModal').modal('show');
            });
        });
    </script>


    {{-- @endsection --}}

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/custom-sweetalert.js')}}"></script>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        @vite(['resources/assets/js/apps/scrumboard.js'])
        <script src="{{asset('plugins/filepond/filepond.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImagePreview.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageCrop.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageResize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageTransform.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/custom-filepond.js')}}"></script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
