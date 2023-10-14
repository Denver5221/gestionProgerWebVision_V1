{{--

/**
*
* Created a new component <x-base-layout/>.
*
*/

--}}

@php
    $isBoxed = layoutConfig()['boxed'];
    $isAltMenu = layoutConfig()['alt-menu'];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $pageTitle }}</title>
    <link rel="icon" type="image/x-icon" href="{{Vite::asset('resources/images/favicon.ico')}}"/>
    @vite(['resources/scss/layouts/modern-light-menu/light/loader.scss'])

    @if (Request::is('modern-light-menu/*'))
        @vite(['resources/layouts/modern-light-menu/loader.js'])
    @elseif ((Request::is('modern-dark-menu/*')))
        @vite(['resources/layouts/modern-dark-menu/loader.js'])
    @elseif ((Request::is('collapsible-menu/*')))
        @vite(['resources/layouts/collapsible-menu/loader.js'])
    @elseif ((Request::is('horizontal-light-menu/*')))
        @vite(['resources/layouts/horizontal-light-menu/loader.js'])
    @elseif ((Request::is('horizontal-dark-menu/*')))
        @vite(['resources/layouts/horizontal-dark-menu/loader.js'])
    @else
        @vite(['resources/layouts/modern-light-menu/loader.js'])
    @endif

     <!-- Stylesheet Bootstrap (CSS) -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Scripts Bootstrap (JS) -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js" integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>




    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/bootstrap.min.css')}}">
    @vite(['resources/scss/light/assets/main.scss', 'resources/scss/dark/assets/main.scss'])

    @if (
            !Request::routeIs('404') &&
            !Request::routeIs('maintenance') &&
            !Request::routeIs('signin') &&
            !Request::routeIs('signup') &&
            !Request::routeIs('lockscreen') &&
            !Request::routeIs('password-reset') &&
            !Request::routeIs('2Step') &&

            // Real Logins
            !Request::routeIs('login')
        )
        @if ($scrollspy == 1) @vite(['resources/scss/light/assets/scrollspyNav.scss', 'resources/scss/dark/assets/scrollspyNav.scss']) @endif
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/waves/waves.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('plugins/highlight/styles/monokai-sublime.css')}}">
        @vite([ 'resources/scss/light/plugins/perfect-scrollbar/perfect-scrollbar.scss'])


        @if (Request::is('modern-light-menu/*'))

        @vite([
            'resources/scss/layouts/modern-light-menu/light/structure.scss',
            'resources/scss/layouts/modern-light-menu/dark/structure.scss',
        ])

        @elseif ((Request::is('modern-dark-menu/*')))

        @vite([
            'resources/scss/layouts/modern-dark-menu/light/structure.scss',
            'resources/scss/layouts/modern-dark-menu/dark/structure.scss',
        ])

        @elseif ((Request::is('collapsible-menu/*')))

        @vite([
            'resources/scss/layouts/collapsible-menu/light/structure.scss',
            'resources/scss/layouts/collapsible-menu/dark/structure.scss',
        ])

        @elseif (Request::is('horizontal-light-menu/*'))

        @vite([
            'resources/scss/layouts/horizontal-light-menu/light/structure.scss',
            'resources/scss/layouts/horizontal-light-menu/dark/structure.scss',
        ])

        @elseif (Request::is('horizontal-dark-menu/*'))

        @vite([
            'resources/scss/layouts/horizontal-dark-menu/light/structure.scss',
            'resources/scss/layouts/horizontal-dark-menu/dark/structure.scss',
        ])

        @else

        @vite([
            'resources/scss/layouts/modern-light-menu/light/structure.scss',
            'resources/scss/layouts/modern-light-menu/dark/structure.scss',
        ])

        @endif

    @endif

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{$headerFiles}}
    <!-- END GLOBAL MANDATORY STYLES -->
</head>
<body @class([
        // 'layout-dark' => $isDark,
        'layout-boxed' => $isBoxed,
        'alt-menu' => ($isAltMenu || Request::routeIs('collapsibleMenu') ? true : false),
        'error' => (Request::routeIs('404') ? true : false),
        'maintanence' => (Request::routeIs('maintenance') ? true : false),
    ]) @if ($scrollspy == 1) {{ $scrollspyConfig }} @else {{''}} @endif   @if (Request::routeIs('fullWidth')) layout="full-width"  @endif >

    <!-- BEGIN LOADER -->
    <x-layout-loader/>
    <!--  END LOADER -->

    {{--

    /*
    *
    *   Check if the routes are not single pages ( which does not contains sidebar or topbar  ) such as :-
    *   - 404
    *   - maintenance
    *   - authentication
    *
    */

    --}}

    @if (
            !Request::routeIs('404') &&
            !Request::routeIs('maintenance') &&
            !Request::routeIs('signin') &&
            !Request::routeIs('signup') &&
            !Request::routeIs('lockscreen') &&
            !Request::routeIs('password-reset') &&
            !Request::routeIs('2Step') &&

            // Real Logins
            !Request::routeIs('login')
        )

        @if (!Request::routeIs('blank'))

            @if (Request::is('modern-light-menu/*'))

                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-vertical-menu classes="{{($isBoxed ? 'container-xxl' : '')}}"/>
                <!--  END NAVBAR  -->

            @elseif ((Request::is('modern-dark-menu/*')))

                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-vertical-menu classes="{{($isBoxed ? 'container-xxl' : '')}}"/>
                <!--  END NAVBAR  -->

            @elseif ((Request::is('collapsible-menu/*')))

                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-vertical-menu classes="{{($isBoxed ? 'container-xxl' : '')}}"/>
                <!--  END NAVBAR  -->

            @elseif (Request::is('horizontal-light-menu/*'))

                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-horizontal-menu/>
                <!--  END NAVBAR  -->

            @elseif (Request::is('horizontal-dark-menu/*'))

                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-horizontal-menu/>
                <!--  END NAVBAR  -->

            @else

                <!--  BEGIN NAVBAR  -->
                <x-navbar.style-vertical-menu classes="{{($isBoxed ? 'container-xxl' : '')}}"/>
                <!--  END NAVBAR  -->

            @endif

        @endif

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container " id="container">

            <!--  BEGIN LOADER  -->
            <x-layout-overlay/>
            <!--  END LOADER  -->

            @if (!Request::routeIs('blank'))

                @if (Request::is('modern-light-menu/*'))

                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.vertical-menu/>
                    <!--  END SIDEBAR  -->

                @elseif ((Request::is('modern-dark-menu/*')))

                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.vertical-menu/>
                    <!--  END SIDEBAR  -->

                @elseif ((Request::is('collapsible-menu/*')))

                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.vertical-menu/>
                    <!--  END SIDEBAR  -->

                @elseif (Request::is('horizontal-light-menu/*'))

                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.horizontal-menu/>
                    <!--  END SIDEBAR  -->

                @elseif (Request::is('horizontal-dark-menu/*'))

                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.horizontal-menu/>
                    <!--  END SIDEBAR  -->

                @else

                    <!--  BEGIN SIDEBAR  -->
                    <x-menu.vertical-menu/>
                    <!--  END SIDEBAR  -->

                @endif

            @endif



            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content {{(Request::routeIs('blank') ? 'ms-0 mt-0' : '')}}">

                @if ($scrollspy == 1)
                    <div class="container">
                        <div class="container">
                            {{ $slot }}
                        </div>
                    </div>
                @else
                    <div class="layout-px-spacing">
                        <div class="middle-content {{($isBoxed ? 'container-xxl' : '')}} p-0">
                            {{ $slot }}
                        </div>
                    </div>
                @endif

                <!--  BEGIN FOOTER  -->
                <x-layout-footer/>
                <!--  END FOOTER  -->

            </div>
            <!--  END CONTENT AREA  -->

        </div>
        <!--  END MAIN CONTAINER  -->

    @else
        {{ $slot }}
    @endif

    @if (
            !Request::routeIs('404') &&
            !Request::routeIs('maintenance') &&
            !Request::routeIs('signin') &&
            !Request::routeIs('signup') &&
            !Request::routeIs('lockscreen') &&
            !Request::routeIs('password-reset') &&
            !Request::routeIs('2Step') &&

            // Real Logins
            !Request::routeIs('login')
        )
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <script src="{{asset('plugins/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('plugins/mousetrap/mousetrap.min.js')}}"></script>
        <script src="{{asset('plugins/waves/waves.min.js')}}"></script>
        <script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
        @if ($scrollspy == 1) @vite(['resources/assets/js/scrollspyNav.js']) @endif

        @if (Request::is('modern-light-menu/*'))
            @vite(['resources/layouts/modern-light-menu/app.js'])
        @elseif ((Request::is('modern-dark-menu/*')))
            @vite(['resources/layouts/modern-dark-menu/app.js'])
        @elseif ((Request::is('collapsible-menu/*')))
            @vite(['resources/layouts/collapsible-menu/app.js'])
        @elseif (Request::is('horizontal-light-menu/*'))
            @vite(['resources/layouts/horizontal-light-menu/app.js'])
        @elseif (Request::is('horizontal-dark-menu/*'))
            @vite(['resources/layouts/horizontal-dark-menu/app.js'])
        @else
            @vite(['resources/layouts/modern-light-menu/app.js'])
        @endif
        <!-- END GLOBAL MANDATORY STYLES -->

    @endif

        {{$footerFiles}}
</body>
</html>
