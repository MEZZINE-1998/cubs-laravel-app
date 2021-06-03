

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f5f3f1; padding: 6px 10px">

            <a class="navbar-brand" href="{{ url('/cvs') }}">
                <img height="35px" src="{{url('Digiwise _ couleur-noir.png')}}">
            </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>


          <div class="collapse navbar-collapse" id="navbarNav">
            
            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto text-right">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</b></a>
                    </li>
                @else
    
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/cvs') }}">{{ __('Engineers') }}</b></a>
                        </li>
                        @if(Auth::user()->post == "Ingenieur")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('cvs/'.Auth::user()->id) }}">{{ __('Profile') }}</b></a>
                        </li>
                        @endif
                        @if(Auth::user()->post == "Entreprise")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('user/'.Auth::user()->id) }}">{{ __('Profile') }}</b></a>
                        </li>
                        @endif
                        @if(Auth::user()->post == "admin")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('partners/') }}">{{ __('Partners') }}</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/'.Auth::user()->id) }}">{{ __('Profile') }}</b></a>
                        </li>
                        @endif
                        <li  class="nav-item">
                        
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{csrf_field()}}
                            </form>
                        </li>
                @endguest
                </ul>

          </div>
        </nav>