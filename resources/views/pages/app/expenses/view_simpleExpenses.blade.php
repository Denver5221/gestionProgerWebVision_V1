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
                    <li class="breadcrumb-item"><a href="{{getRouterValue();}}/app/expenses/">Entrées-Sorties</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><b>Voir</b></li>
                </ol>
            </nav>
        </div>
        <!-- /BREADCRUMB -->



        @foreach($categorie->entreesSorties as $entreeSortie)
        <div class="modal fade" id="editProjectModal{{  $entreeSortie->id }}" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center text-center">
                        <h5 class="modal-title" id="createProjectModalLabel">Éditer l'Entrée/Sortie <b>{{  $entreeSortie->nom }}</b></h5>
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



                        <form action="{{ route('categoriesexpenses.update', $entreeSortie->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div id="champs-container" class="row mb-2">
                                <div class="col-xxl-9 col-xl-12 col-lg-2 col-md-4 col-sm-2">
                                    <div class="widget-content widget-content-area blog-create-section ">
                                        <div class="row mb-2">
                                            <div class="col-sm-12">
                                                <input type="text" name="nom" class="form-control form-control-sm" id="Post-Title" value="{{  $entreeSortie->nom }}">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-12">
                                                <input type="text" name="description" class="form-control form-control-sm" id="Post-Title" value="{{  $entreeSortie->description }}">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-12">
                                                <input type="number" name="montant" class="form-control form-control-sm" id="Post-Title" value="{{  $entreeSortie->montant }}">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-sm-12">
                                                <select id="status" name="status" class="form-select form-select-sm @error('status') is-invalid @enderror" aria-label=".form-select-sm example" required>
                                                    <option selected disabled>Status</option>
                                                    <option value="0" @if($entreeSortie->status == 0) selected @endif>Entrée</option>
                                                    <option value="1" @if($entreeSortie->status == 1) selected @endif>Sortie</option>
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
                                                    @foreach($alldepenses as $data)
                                                        <option value="{{ $data->id }}" {{ $entreeSortie->id_categorie == $data->id ? 'selected' : '' }}>{{ $data->nom }}</option>
                                                    @endforeach
                                                </select>
                                                @error('categorie')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="file">Sélectionner une facture</label>
                                                <input type="file" name="file" accept="image/*,.pdf" class="form-control form-control-sm @error('file') is-invalid @enderror" id="file" placeholder="Fichier" >
                                                <span>
                                                    @if($entreeSortie->file)
                                                        {{ $entreeSortie->file }}
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
    @endforeach







            <div class="row mb-4 layout-spacing layout-top-spacing">

                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area table-responsive">
                            <center><br>
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Liste des dépenses liées à la catégorie <b>{{ $categorie->nom }}</b></h4>
                                    </div>
                                </div>
                            </center>
                            <table id="style-3" class="table table-responsive style-3 dt-table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Montant</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Fichier</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 1; @endphp
                                    {{-- @if ($categorie && $categorie->entreeSortie) --}}
                                        @foreach($categorie->entreesSorties as $entreeSortie)

                                        <tr>
                                            <td class="checkbox-column text-center"> {{ $counter }} </td>
                                            <td>{{ $entreeSortie->nom }} </td>
                                            <td>{{ $entreeSortie->description }}</td>
                                            <td>{{ $entreeSortie->montant }} </td>
                                            <td class="text-center">{{ $entreeSortie->updated_at->format('d/m/y') }}</td>
                                            <td class="text-center">
                                                <span class="shadow-none badge badge-{{ $entreeSortie->status == 0 ? 'success' : 'warning' }}">
                                                    {{ $entreeSortie->status == 0 ? 'Entrée' : 'Sortie' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if($entreeSortie->file)
                                                    <a href="{{ asset('uploads/EntreeSortieCategorie/' . $entreeSortie->file) }}" target="_blank">
                                                        <i class="las la-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('uploads/EntreeSortieCategorie/' . $entreeSortie->file) }}" download>
                                                        <i class="las la-download"></i>
                                                    </a>
                                                @else
                                                    Aucun fichier
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-grid gap-2 d-md-block">
                                                    <button style="font-size: 65%" data-bs-toggle="modal" data-bs-target="#editProjectModal{{  $entreeSortie->id }}" class="btn btn-warning btn-sm _effect--ripple waves-effect waves-light" type="button">Éditer</button>

                                                    {{-- <button id="delete-button" class="btn btn-danger btn-sm _effect--ripple waves-effect waves-light delete-button" type="button" data-delete-url="{{ route('expenses.destroy', $entreeSortie->id) }}">Supprimer</button> --}}
                                                    <button style="font-size: 65%" class="delete-button btn btn-danger btn-sm _effect--ripple waves-effect waves-light warning confirm" data-delete-url="{{ route('categoriesexpenses.destroy', $entreeSortie->id) }}">Supprimer</button>
                                                </div>
                                            </td>

                                        </tr>
                                        @php $counter++; @endphp
                                        @endforeach
                                    {{-- @else
                                        <tr>
                                            <td colspan="7" class="text-center">Aucune entrée/sortie trouvée pour cette catégorie.</td>
                                        </tr>
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="container layout-spacing layout-top-spacing" style="margin-left: 25%">
                <div class="row justify-content-center">
                    <div class="col align-self-center">
                        <table class="table custom-table text-center w-50">
                            <thead>
                                <tr>
                                    <th colspan="3">Détails des Entrées/Sorties</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total des entrées</td>
                                    <td>Total des sorties</td>
                                    <td>Différence</td>
                                </tr>
                                <tr>
                                    <td>{{ $totalEntrees }}</td>
                                    <td>{{ $totalSorties }}</td>
                                    <td>{{ $difference }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <style>
                .custom-table {
                    border: 2px solid #cbd8e9; /* Remplacez cette couleur par celle de votre choix */
                }
                .custom-table th,
                .custom-table td {
                    border: 2px solid #4b92ee; /* Remplacez cette couleur par celle de votre choix */
                }
            </style>


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
        <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepond.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImagePreview.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageCrop.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageResize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageTransform.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepondPluginFileValidateSize.min.js')}}"></script>
        <script src="{{asset('plugins/tagify/tagify.min.js')}}"></script>


        <script>


            /**
             * =====================
             *      Blog Tags
             * =====================
            */
            // The DOM element you wish to replace with Tagify
            var input = document.querySelector('.blog-tags');

            // initialize Tagify on the above input node reference
            new Tagify(input)


            /**
             * =======================
             *      Blog Category
             * =======================
            */
            var input = document.querySelector('input[name=category]');

            new Tagify(input, {
                whitelist: ["Themeforest","Admin","Dashboard","Laravel","Sale","Vue","React","Cork Admin"],
                userInput: false
            })


          </script>


    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
