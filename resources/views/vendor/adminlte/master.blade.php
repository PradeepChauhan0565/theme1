<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    {{-- Configured Stylesheets --}}
    @include('adminlte::plugins', ['type' => 'css'])

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    @if(config('adminlte.google_fonts.allowed', true))
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @endif
    @else
    <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
    @if(app()->version() >= 7)
    @livewireStyles
    @else
    <livewire:styles />
    @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif
    <style>
        body {
            font-family: Calibri, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        /* Button used to open the chat form - fixed at the bottom of the page */
        .open-button {

            padding: 5px 5px;
            border: none;
            cursor: pointer;
            opacity: 1;
            position: fixed;
            bottom: 23px;
            right: 28px;
            border-radius: 50%;
        }

        /* The popup chat - hidden by default */
        .chat-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            /* border: 3px solid #f1f1f1; */
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            padding: 10px;
            background-color: white;
        }

        /* Full-width textarea */
        .form-container textarea {
            width: 85%;
            padding: 15px 5px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
            resize: none;
            min-height: 50px;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .form-container .my-btn {
            width: 15%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
            resize: none;
            min-height: 50px;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        /* When the textarea gets focus, do something */
        .form-container textarea:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/send button */
        /* .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        } */

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }

        .chatContainer {

            padding: 10px 5px;
        }

        /* width */
        .my-scroll::-webkit-scrollbar {
            width: 10px;
            border-radius: 15px;
        }

        /* Track */
        .my-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 15px;
        }

        /* Handle */
        .my-scroll::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        .my-scroll::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body class="@yield('classes_body')" @yield('body_data')>
    {{-- @php
    function dropdown($table, $condition = null)
    {
    return DB::table($table)->when($condition, function ($q) use ($condition) {
    $q->whereRaw($condition);
    })->get();
    }
    @endphp --}}
    {{-- Body Content --}}
    @yield('body')

    {{-- <button class="open-button" onclick="openForm()"><i class="far fa-comments" style="font-size: 30px"></i></button> --}}
    <div class="form-container">
        <div class="chat-popup" id="myForm">
            @auth
            @livewire('chat-bot-component')
            @endauth
        </div>
    </div>
    <script>
        function openForm() {
          document.getElementById("myForm").style.display = "block";
        $(function () {
            var ChatDiv = $('#chatContainer');
            var height = ChatDiv[0].scrollHeight;
            ChatDiv.scrollTop(height);
        });
        Livewire.emit('chatOpen')
        }   
        
        function closeForm() {
            Livewire.emit('chatClose')
          document.getElementById("myForm").style.display = "none";
        }

        document.addEventListener('chatScrollBottom',()=>{
            $(function () {
            var ChatDiv = $('#chatContainer');
            var height = ChatDiv[0].scrollHeight;
            console.log(height);
            ChatDiv.scrollTop(height);
        });
        });

        document.getElementById('chatContainer').addEventListener('scroll', event => {
    const {scrollHeight, scrollTop, clientHeight} = event.target;

    if (Math.abs(scrollHeight - clientHeight - scrollTop) < 1) {
        console.log('scrolled');
    }
});
        
    </script>
    {{-- CUstome code Start --}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    {{-- <div wire:ignore aria-live="polite" aria-atomic="true" style="position: absolute; top:0; left:0;width:100%;"
        id="tt">
        <div wire:ignore class="toast1 bg-success" style="position: absolute; top: 10px; left: 10px; z-index: 9999;"
            data-autohide="true" data-delay="3000">
            <div class="toast-body">
                Updated Successfully...
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div> --}}
    <script>
        $(document).ready(function(){
        window.addEventListener('livewireUpdated', event => {
            $("#exampleModal").modal('hide');
            $('.toast').toast('show');
            console.log('updated');
        })
        window.addEventListener('livewireEdited', event => {
            $("#exampleModal").modal('show');
            console.log('Edited');
        })
    });
    </script>
    {{-- Custom code End --}}
    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    {{-- Configured Scripts --}}
    @include('adminlte::plugins', ['type' => 'js'])

    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
    <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
    @if(app()->version() >= 7)
    @livewireScripts
    @else
    <livewire:scripts />
    @endif
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')
    {{-- <script src="{{ asset('vendor/adminlte/dist/js/Chart.min.js') }}"></script> --}}

</body>

</html>