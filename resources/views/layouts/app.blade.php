<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('logo.png')}}" />
    <title>CUBS</title>
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
<body style="background-color: #faf9f8; font-size: 90%;margin-top: 80px">
    <div id="app">
     
        @include('partials.menu')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('partials.flash')
                </div>
            </div>   
        </div>
        <link href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU'" crossorigin="anonymous">
        
        @yield('content')
        @yield('javascripts')

    </div>
</body>

<footer class="footer">
    <div class="footer_top" style="padding: 0px; margin-top: 80px">
        <!-- <div class="container"><hr><br><br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer_widget">
                        <div class="footer_logo">
                            <a href="#">
                                <img height="40px" src="{{asset('logo.jpg')}}" alt="">
                                <br>
                            </a>
                        </div>
                        <div style="margin-top: 20px">
                            <p class="copyright">© CUBS 2021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</footer>


<style type="text/css">

[title]:hover:after {
  visibility: visible;
}
  
[title]:after {
    content: attr(title);
    background-color: #000;
    border-radius: 30px;    
    color: #fff;
    position: absolute;
    padding: 0px 20px;
    visibility: hidden;
    right: 6ch;
    opacity: 1;
}

.userStyle{
    background-color: #fff; 
    border-radius: 4px; 
    padding: 10px; 
    margin-bottom: 6px;
    width: 105%;
    box-shadow: 0px 0px 1px 1px rgba(0, 0, 0, .1);
    border-top: 2px solid #fc9330;
}

@keyframes shake
{
0% { transform: translate(1px, -1px) rotate(0deg);}
10% { transform: translate(1px, -3px) rotate(-1deg);}
20% { transform: translate(1px, -5px) rotate(-3deg);}
30% { transform: translate(1px, -7px) rotate(0deg);}
40% { transform: translate(1px, -9px) rotate(1deg);}
50% { transform: translate(1px, -11px) rotate(3deg);}
60% { transform: translate(1px, -9px) rotate(0deg);}
70% { transform: translate(1px, -7px) rotate(-1deg);}
80% { transform: translate(1px, -5px) rotate(-3deg);}
90% { transform: translate(1px, -3px) rotate(0deg);}
100% { transform: translate(1px, -1px) rotate(-1deg);}
}

.moreInfoTestStyle{
     position:absolute;
     background-color: #FFF;
     padding: 30px;
     width: 60%;
     right:20%;
     top: 50%;
     -ms-transform: translateY(-50%);
     transform: translateY(-50%);
     border-radius: 4px;
     box-shadow: 0px 0px 0px 1000px rgba(0, 0, 0, .4);
     z-index: 9999;
     position: fixed;
  }
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
