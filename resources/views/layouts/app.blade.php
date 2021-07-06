<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('icon.png')}}" />
    <title>DIGIWISE</title>
    <script>
  window.Laravel ={!! json_encode([
      'csrfToken' => csrf_token()
    ]) !!};
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>
    <link rel="stylesheet" href="{{ asset('https://use.fontawesome.com/releases/v5.8.1/css/all.css')}}" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf')}}" crossorigin="anonymous">

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        

    <!-- Styles -->
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">

</head>
<body style="background-color: #faf9f8; font-size: 90%;">
    <div id="app">
        
            @include('partials.menu')

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @include('partials.flash')
                    </div>
                </div>   
            </div>
            
            @yield('content')
            @yield('javascripts')

    </div>
<a href="#top" class="gototop" style="border-radius: 50%"><i style="color: black" class="fas fa-angle-double-up"></i></a>

</body>

<footer class="footer">
    <div class="footer_top" style="padding: 0px; margin-bottom: 20px; margin-top: 80px">
        <div class="container"><hr><br><br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer_widget">
                        <div class="footer_logo">
                            <a href="#">
                                <img height="40px" src="{{asset('icon.png')}}" alt="">
                                <br>
                            </a>
                        </div>
                        <div style="margin-top: 20px">
                            <p class="copyright">© DIGIWISE 2021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<style type="text/css">

.gototop {
  width: 45px;
  height: 45px;
  position: fixed;
  right: 20px;
  z-index: 0;
  background: #6592d6;
  text-align: center;
  line-height: 45px;
  -webkit-box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.2);
  box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.2);
  bottom: 30px; }
.gototop.active {
  bottom: 15px; }
.gototop span {
  font-size: 18px;
  color: #fff; }

.ongoing{
  float: right;
  background-color: #f5d2c9;
  color: #000;
  padding: 1px 8px;
  border:1px solid black;
  border-radius: 3px;
  margin-right: 15px;
  font-size: 11px;
}

.success-me{
  padding: 15px 25px; 
  font-size: 13px; 
  color: green; 
  background-color: #F2F2F2; 
  border: 1 solid green; 
  border-radius: 4px;
}

.techState{
  background-color: #f1f1f1;
  color: black;
  padding: 2px 8px;
  border:1px solid black;
  border-radius: 10px;
  margin-left: 10px;
  cursor: pointer;
}

.progressbar {
  counter-reset: step;
}
.progressbar li {
  list-style: none;
  display: inline-block;
  width: 16%;
  position: relative;
  text-align: center;
  cursor: pointer;
}
.progressbar li:before {
  content: counter(step);
  counter-increment: step;
  width: 30px;
  height: 30px;
  line-height : 30px;
  border: 1px solid #ddd;
  border-radius: 100%;
  display: block;
  text-align: center;
  margin: 0 auto 10px auto;
  background-color: #fff;
}
.progressbar li:after {
  content: "";
  position: absolute;
  width: 100%;
  height: 1px;
  background-color: #ddd;
  top: 15px;
  left: -50%;
  z-index : -1;
}
.progressbar li:first-child:after {
  content: none;
}
.progressbar li.active {
  color: green;
}
.progressbar li.active:before {
  border-color: green;
} 
.progressbar li.active + li:after {
  background-color: green;
}
</style>
</html>
