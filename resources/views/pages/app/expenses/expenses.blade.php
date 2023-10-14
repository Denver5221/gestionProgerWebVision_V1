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
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>


    <!-- BREADCRUMB -->

    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href=""><b>Entrées-Sorties</b></a></li>
            </ol>
        </nav>
    </div>

    <!-- /BREADCRUMB -->

    <!-- <div class="row layout-top-spacing" id="cancel-row">
        <br>
        <div class=" widget-content seperator-header text-center">
            <a href="{{getRouterValue();}}/app/projet/add"> <button class="btn btn-success mb-2 me-8 btn-lg" >Créer un projet</button></a>
            <a href="{{getRouterValue();}}/forum/categorie"><button class="btn btn-success mb-2 me-8 btn-lg">Créer une Categorie</button></a>
            <a href="{{getRouterValue();}}/forum/spams"><button class="btn btn-success mb-2 me-8 btn-lg">Spams</button></a>
            <a href="{{getRouterValue();}}/forum/utilisateurs"><button class="btn btn-success mb-2 me-8 btn-lg">Utilisateurs</button></a>
        </div>

    </div> -->








    <!-- Form Button trigger modal -->

        <!-- Modal -->


    <div class="row layout-top-spacing" id="cancel-row">
        <br>
        <div class="widget-content seperator-header text-center">
            <button class="btn btn-success mb-2 me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#createProjectModal">Ajouter une dépense de projet</button>
            <button class="btn btn-success mb-2 me-8 btn-lg" data-bs-toggle="modal" data-bs-target="#createDepenseModal">Ajouter une dépense simple</button>
            <!-- ... -->
        </div>
    </div>


    <!--    /**
            * ==================================================
            *    @Modal -  Expenses Project and Simple, Category
            *       Début
            * ==================================================
            */
    -->

    <!-- Depenses Projet Modal create -->
    <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="createProjectModalLabel"><b>Ajouter une dépense</b></h5>
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



                    <form id="myForm" method="POST" action="{{ route('expenses.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div id="champs-container" class="row mb-2">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="text" name="nom" class="form-control form-control-sm @error('nom') is-invalid @enderror" id="nom" placeholder="Nom de la dépense" required>
                                                @error('nom')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="text" name="description" class="form-control form-control-sm @error('description') is-invalid @enderror" id="description" placeholder="Description" >
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="number" name="montant" class="form-control form-control-sm @error('montant') is-invalid @enderror" id="montant" placeholder="Montant" required>
                                            @error('montant')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <select id="status" name="status" class="form-select form-select-sm @error('status') is-invalid @enderror" aria-label=".form-select-sm example" required>
                                                <option selected disabled>Status</option>
                                                <option value="0">Entrée</option>
                                                <option value="1">Sortie</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <select name="id_projet" class="form-select form-select-sm @error('id_projet') is-invalid @enderror" aria-label=".form-select-sm example" required>
                                                <option selected disabled>Sélectionner le projet</option>
                                                @foreach($projets as $projet)
                                                    <option value="{{ $projet->id }}">{{ $projet->nom }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_projet')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-12">
                                            <label for="file">Sélectionner une facture</label>
                                            <input type="file" name="file" accept="image/*,.pdf" class="form-control form-control-sm @error('file') is-invalid @enderror" id="file" placeholder="Fichier" required>
                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success mt-2 mb-2">Ajouter</button>
                        </div>
                    </form>
                </div>

            <script>
                // Récupérer le formulaire
                const form = document.getElementById('myForm');

                // Écouter la soumission
                form.addEventListener('submit', function(e) {

                  // Réinitialiser les erreurs
                  resetErrors();

                  // Validation
                  if(!form.elements.nom.value) {
                    e.preventDefault();
                    setError('nom', 'Le nom est obligatoire');
                  }

                  if(!form.elements.montant.value) {
                    e.preventDefault();
                    setError('montant', 'Le montant est obligatoire');
                  }

                });

                // Afficher l'erreur sur le champ
                function setError(fieldName, msg) {

                  // Récupérer l'élément d'erreur
                  const errElement = form.elements[fieldName].parentElement.querySelector('.error');

                  // Définir le message
                  errElement.innerHTML = msg;
                  errElement.classList.add('show');

                }

                // Masquer toutes les erreurs
                function resetErrors() {

                  document.querySelectorAll('.error').forEach(err => {
                    err.classList.remove('show');
                  });

                }
            </script>

            </div>
        </div>
    </div>



    <!-- Depenses Projet Modal Edit -->



    <!-- Depense simple Modal -->
    <div class="modal fade" id="createDepenseModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="createProjectModalLabel"><b>Ajouter une dépense</b></h5>
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


                    <form id="myForm" method="POST" action="{{ route('categoriesexpenses.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div id="champs-container" class="row mb-2">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="text" name="nom" class="form-control form-control-sm @error('nom') is-invalid @enderror" id="nom" placeholder="Nom de la dépense" required>
                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="text" name="description" class="form-control form-control-sm @error('description') is-invalid @enderror" id="description" placeholder="Description" >
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="number" name="montant" class="form-control form-control-sm @error('montant') is-invalid @enderror" id="montant" placeholder="Montant" required>
                                            @error('montant')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <select name="status" class="form-select form-select-sm @error('status') is-invalid @enderror" aria-label=".form-select-sm example" required>
                                                <option selected disabled>Status</option>
                                                <option value="0">Entrée</option>
                                                <option value="1">Sortie</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <select name="categorie" class="form-select form-select-sm @error('categorie') is-invalid @enderror" aria-label=".form-select-sm example" required>
                                                <option selected disabled>Sélectionner la catégorie</option>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                                @endforeach
                                            </select>
                                            @error('categorie')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-12">
                                        <label for="file">Sélectionner une facture</label>
                                            <input id="file" type="file" name="file" accept="image/*,.pdf" class="form-control form-control-sm @error('file') is-invalid @enderror" id="file" placeholder="Fichier" required>
                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
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

    <!-- Depenses Simple Modal Edit -->
    <div class="modal fade" id="editSimpleModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="createProjectModalLabel"><b>Éditer une dépense</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div id="champs-container" class="row mb-2">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-sm" id="Post-Title" value="Derme Fadil">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-sm" id="Post-Title" value="Comment faire des">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control form-control-sm" id="Post-Title" value="100000">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected disabled>Status</option>
                                                <option value="1" selected>Actif</option>
                                                <option value="2">Inactif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-12">
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                <option selected disabled>Sélectionner la catégorie</option>
                                                <option value="1" selected>Dev</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-12">
                                            <label for="image_uploads">Sélectionner une facture</label>
                                                <input id="image_uploads" type="file" accept="image/*,.pdf" class="form-control form-control-sm" id="Post-Title" value="Fichier.pdf"><span>Fichier.pdf</span>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success mt-2 mb-2 widget-content icon-success" data-bs-dismiss="modal">Ajouter</button>
                </div>

            </div>
        </div>
    </div>


    <!-- Categories Modal -->

  <div class="modal fade" id="createCategorieModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="createProjectModalLabel">Ajouter une Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div id="champs-container" class="row mb-2">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">
                                    <div class="row mb-2">
                                    <div class="form-floating mb-3 ">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                        <label style="responsive: true; margin-left:3%;" for="floatingInput">Nom</label>
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success mt-2 mb-2 widget-content icon-success" data-bs-dismiss="modal">Ajouter</button>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
                <script>
                    document.querySelector('.widget-content.icon-success').addEventListener('click', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Categorie ajoutée avec succès',
                        });
                    });
                </script>

            </div>
        </div>
    </div>




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

    <div class="row layout-spacing mb-4">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow shadow rounded">
                <div class="widget-content widget-content-area">
                    <center><br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste des dépenses liées au Projet</h4>
                            </div>
                        </div>
                    </center>

                    <table id="style-3" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th class="text-center dt-no-sorting">N°</th>
                                <th class="text-center dt-no-sorting">Projet</th>
                                <th class="text-center dt-no-sorting">Montant</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($dataParProjet) > 0)
                                    @php $counter = 1; @endphp
                                @foreach($dataParProjet as $data)
                                    <tr>
                                        <td class="checkbox-column text-center">{{ $counter }}</td>
                                        <td class="text-center dt-no-sorting">{{ $data['projet']->nom ?? 'Aucune entrées/sorties'  }}</td>
                                        <td class="text-center dt-no-sorting">{{ $data['difference'] }}</td>
                                        <td class="text-center">
                                            <div class="d-grid gap-2 d-md-block">
                                                <a href="{{ route('expenses2.show2', $data['projet']->id ) }}">
                                                    <button style="font-size: 65%" class="btn btn btn-info btn-sm _effect--ripple waves-effect waves-light" type="button">Voir</button>
                                                </a>
                                                <button style="font-size: 65%" class="delete-button btn btn-danger btn-sm _effect--ripple waves-effect waves-light warning confirm" data-delete-url="{{ route('projects.destroy', $data['projet']->id) }}">Supprimer</button>

                                            </div>
                                        </td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="4">Aucune entrées/sorties pour le projet.</td>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                    {{-- @endif --}}

                </div>
            </div>
        </div>
    </div>


    {{-- @foreach($dataParProjet as $data)
    <div class="modal fade" id="editProjectModal{{ $data['projet']->id ?? 0 }}" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header justify-content-center text-center">
                    <h5 class="modal-title" id="createProjectModalLabel"><b>Éditer une dépense</b></h5>
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
                    <form action="{{ route('expenses.update1', $data['projet']->id ?? 0) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div id="champs-container" class="row mb-2">
                            <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                <div class="widget-content widget-content-area blog-create-section ">

                                    <div class="row mb-4">
                                        <div class="col-sm-12">
                                            <select name="id_projet" class="form-select form-select-sm @error('id_projet') is-invalid @enderror" aria-label=".form-select-sm example">
                                                <option selected disabled>Sélectionner le projet</option>
                                                @foreach($projets as $projetItem)
                                                <option value="{{ $projetItem->id }}" {{ (isset($data['projet']->id) && $data['projet']->id == $projetItem->id) ? 'selected' : '' }}>
                                                    {{  $projetItem->nom}}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('id_projet')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-success mt-2 mb-2 widget-content icon-success" data-bs-dismiss="modal">Ajouter</button>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>
    @endforeach --}}


    <!-- Lié aux Catégories -->

    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow shadow rounded">
                <div class="widget-content widget-content-area">
                    <center><br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste des dépenses Simples</h4>
                            </div>
                        </div>
                    </center>
                    {{-- @if($depenses->isEmpty())
                        <h4 class="text-center mt-4">Aucune Entrée/Sortie n'a été trouvé.</h4>
                    @else --}}
                    <table id="style-3" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th class="text-center dt-no-sorting">N°</th>
                                <th class="text-center dt-no-sorting">Catégories</th>
                                <th class="text-center dt-no-sorting">Montant</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($dataParCategorie) > 0)
                                    @foreach ($dataParCategorie as $dataCat)

                                <tr>
                                    <td class="checkbox-column text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center dt-no-sorting">{{ $dataCat['categorie']->nom  ?? 'Aucune entrées/sorties'}}</td>
                                    <td class="text-center dt-no-sorting">{{ $dataCat['difference'] }}</td>
                                    <td class="text-center">
                                        <div class="d-grid gap-2 d-md-block">
                                            <a href="{{ route('expenses.show1', $dataCat['categorie']->id) }}">
                                                <button style="font-size: 65%" class="btn btn btn-info btn-sm _effect--ripple waves-effect waves-light" type="button">Voir</button>
                                            </a>
                                            {{-- <button data-bs-toggle="modal" data-bs-target="#editSimpleModal" class="btn btn-warning btn-sm _effect--ripple waves-effect waves-light" type="button">Éditer</button> --}}
                                            <button style="font-size: 65%" class="btn btn-danger btn-sm _effect--ripple waves-effect waves-light delete-button" data-delete-url="{{ route('categories.destroy', $dataCat['categorie']->id) }}" type="button">Supprimer</button>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                        @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="4">Aucune entrées/sorties pour la catégorie.</td>
                            </tr>
                        @endif
                </tbody>
                    </table>
                    {{-- @endif --}}

                </div>
            </div>
        </div>
    </div>









        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.10/dist/sweetalert2.all.min.js"></script>
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
