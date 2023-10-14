<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/tagify/tagify.css')}}">

        @vite(['resources/scss/light/assets/forms/switches.scss'])
        @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/light/plugins/tagify/custom-tagify.scss'])
        @vite(['resources/scss/light/assets/apps/blog-create.scss'])


        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>


        <!-- BREADCRUMB -->
        <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{getRouterValue();}}/forum">Forum</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                </ol>
            </nav>
        </div>
        <!-- /BREADCRUMB -->
        <form class="mt-0">

            <div class="row mb-4 layout-spacing layout-top-spacing">

                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    

                    <div class="widget-content widget-content-area blog-create-section">
                        

        
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="Post-Title" placeholder="Titre" value="Elegant and useful Admin Templates">
                            </div>
                        </div>
        
                        
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                </span>
                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Description" rows="10" >Aliquam leo elit, semper sed diam non, efficitur semper mi. Sed pulvinar velit massa, nec ornare arcu laoreet non. Quisque dignissim lectus eget lectus pulvinar imperdiet. Aliquam dictum porttitor laoreet. Duis ac tortor non sem vestibulum interdum in quis dui. Pellentesque nec augue eleifend, convallis tortor ac, posuere turpis. Nulla commodo euismod felis vitae eleifend. Morbi cursus maximus mauris ac lacinia. Nullam tellus dolor, sodales vitae nunc id, luctus lacinia leo. Sed id urna venenatis lacus lobortis ullamcorper nec dignissim odio.</textarea>
                                
                            </div>
                        </div> 
                    </div>


                    
                </div>
        
                <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-xxl-0 mt-4">
                    <div class="widget-content widget-content-area blog-create-section">
                        <div class="row">
                            <div class="col-xxl-12 mb-4">
                                <div class="switch form-switch-custom switch-inline form-switch-primary">
                                    <input class="switch-input" type="checkbox" role="switch" id="showPublicly" checked>
                                    <label class="switch-label" for="showPublicly">Publié</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 mb-4">
                                <div class="switch form-switch-custom switch-inline form-switch-primary">
                                    <input class="switch-input" type="checkbox" role="switch" id="enableComment">
                                    <label class="switch-label" for="enableComment">Activer les comments</label>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="tags">Tags</label>
                                <input id="tags" class="blog-tags"  value="Admin, Themeforest, Bootstrap">
                            </div>
        
                            <div class="col-xxl-12 col-md-12 mb-4">
                                <label for="category">Categories</label>
                                <input id="category" name="category" value="Themeforest, Cork Admin, Dashboard, Vue, Laravel" placeholder="Choisissez...">
                            </div>
        
                           
        
                            <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                                <button class="btn btn-success w-100">Modifier l'actualité</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
        
            </div>
            
        </form>





    
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