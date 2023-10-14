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
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->


     <!-- BREADCRUMB -->
     <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Liste des Catégories de Projets</li>
                </ol>
            </nav>
        </div>
        <!-- /BREADCRUMB -->


        <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <center><br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Liste des Catégories</h4>
                            </div>
                        </div>
                    </center><br><br>

                    <div class="row scrumboard" id="cancel-row">
                        <div class="col-lg-12 layout-spacing">
                            <div class="task-list-section">
                                @if(count($categories) > 0)
                                @foreach($categories as $categorie)
                                <div data-section="{{ 's-' . $loop->index }}" class="task-list-container" data-connect="sorting">
                                    <a href="{{ route('projet.show', ['categorie' => $categorie->id]) }}">
                                        <div class="connect-sorting">
                                            <div class="task-container-header">
                                                <h4 class="s-heading" style="font-weight:900; margin-left:16%" data-listTitle="{{ $categorie->nom }}">{{ $categorie->nom }}</h4>
                                            </div>
                                            <div class="connect-sorting-content" data-sortable="true">
                                                {{-- @foreach ($categorie->projets as $projet) --}}
                                                <div data-draggable="true" class="card img-task">
                                                    <div class="card-body">
                                                        <div class="task-content">
                                                            <img src="{{ Vite::asset('resources/images/taskboard.jpg') }}" class="img-fluid" alt="scrumboard">
                                                        </div>
                                                        <div class="task-header">
                                                            <div class="">
                                                                <h5>Description :</h5>
                                                                <p class="m-2" data-listTitle="{{ $categorie->description }}">{{ $categorie->description }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- @endforeach --}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                                @else
                                <p>Aucune catégorie n'a de projets associés.</p>
                            @endif
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>



    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        @vite(['resources/assets/js/apps/scrumboard.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>
