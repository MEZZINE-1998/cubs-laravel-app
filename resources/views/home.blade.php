<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('logo.jpg')}}" />
        <title>CV-INO</title>
        <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>

         <link rel="dns-prefetch" href="//fonts.gstatic.com">
         <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">



        <!-- Styles -->
        
    </head>
    <body style="background-color: #f8f8fa">
        <nav  class="navbar navbar-expand-lg fixed-top navbar-light" style="height: 50px;background-color: #f1f1f5">
            
                <a style="margin-left: 20px" class="navbar-brand" href="{{ url('/') }}">
                   <span style="color: black">DIGIWISE</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                            @if (Route::has('login'))
                                
                                    @auth
                                        <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/cvs') }}">Home</a>
                                        </li>
                                    @else
                                    <div class="row">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                        @if (Route::has('register'))
                                        <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                       </li> 
                                       </div>
                                        @endif
                                    @endauth
                                
                            @endif

                    </ul>
                </div>

        </nav>


        


        </div>
    </body>

</html>