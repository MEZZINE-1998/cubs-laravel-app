        
        @guest
            
        @else
        <!-- preloader -->
        <style type="text/css">
          .preloader
          {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100vh;
          background: #fff;
          z-index: 9999;
          text-align: center;
          }

          .preloader-icon
          {
          position: relative;
          top: 45%;
          width: 100px;
          border-radius: 50%;
          animation: shake 1.5s infinite;
          }
        </style>

        <div class="preloader">
          <b class="preloader-icon">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </b> 
        </div>
        <script type="text/javascript">
          window.onload = function(){ document.querySelector(".preloader").style.display = "none"; }
        </script>

        
        <!-- menu -->
        <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #6592d6;box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, .2);">
          <a class="navbar-brand" href="{{ url('/home') }}">
            <img height="35px" src="{{url('logo2.png')}}"> <b style="color: #000">ROMAFC</b>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto text-right">
            <!-- Authentication Links -->
              <li class="nav-item">
                @if(Auth::user()->categorie != 'Admin')
                <a href="{{url('userhome/'.Auth::user()->id)}}" class="nav-link" style="color: white"><b>{{Auth::user()->name}}</b>
                @else
                <a href="{{url('profileuser')}}" class="nav-link" style="color: white"><b>{{Auth::user()->name}}</b>
                @endif
                
                @if(Auth::user()->gender == "Homme")
                <img style="border-radius: 50%; margin-left: 6px" height="35px" src="{{url('male.jpg')}}">
                @else
                <img style="border-radius: 50%; margin-left: 6px" height="35px" src="{{url('female.jpg')}}">
                @endif
                </a> 
              </li>
            </ul>
          </div>
        </nav>

        <!-- sidebar menu  -->
        
        @if(Auth::user()->categorie == 'Joueur')
        <a title="profil" href="{{url('userhome/'.Auth::user()->id)}}" class="gototop" style="border-radius: 50%; margin-bottom: 340px; background-color: #333"><i style="color: white" class="fas fa-star"></i></a>
        @else
        <a title="Ajouter" href="{{url('/newUser')}}" class="gototop" style="border-radius: 50%; margin-bottom: 550px; background-color: #333"><i style="color: white" class="fas fa-plus"></i></a>
        <a title="Tests" href="{{url('/tests')}}" class="gototop" style="border-radius: 50%; margin-bottom: 480px; background-color: #333"><i style="color: white" class="fas fa-running"></i></a>
        <a title="Absences" href="{{url('/absences')}}" class="gototop" style="border-radius: 50%; margin-bottom: 410px; background-color: #333"><i style="color: white" class="fas fa-user-times"></i></a>
        <a title="Utilisateurs" href="{{url('/users')}}" class="gototop" style="border-radius: 50%; margin-bottom: 340px; background-color: #333"><i style="color: white" class="fas fa-users"></i></a>
        @endif
        <a title="calendrier" href="{{url('/home')}}" class="gototop" style="border-radius: 50%; margin-bottom: 270px; background-color: #333"><i style="color: white" class="far fa-calendar-alt"></i></a>
        <a title="Configuration" href="{{url('/profileuser')}}" class="gototop" style="border-radius: 50%; margin-bottom: 200px; background-color: #333"><i style="color: white" class="fas fa-cog"></i></a>
        <a title="Déconnexion" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="gototop" style="border-radius: 50%; margin-bottom: 130px; background-color: #333"><i style="color: white" class="fas fa-power-off"></i></a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{csrf_field()}}
        </form>
        <a href="#top" class="gototop" style="border-radius: 50%"><i style="color: black" class="fas fa-angle-double-up"></i></a>

        @endguest