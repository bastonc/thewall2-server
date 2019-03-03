    <?php
    $logo_text="Дипломи радіоаматорів України";
    $index_link_text ="Головна";
    $closeprogram_link_text="Завершені програми";
    $enter_link_text="Увійти як дипломний менеджер";
    $register_link_text="Зареєструватись як дипломний менеджер";
    $addlogsps_link_text="Додати LOG СПС";
    $more_text_link="БІЛЬШЕ";
    $cabinet_link_text="Кабінет";
    $logout_link_text="Вийти";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Theme Made By www.w3schools.com - No Copyright -->
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Forum|Montserrat|Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Forum', cursive;
           font-size: 22px;
            color: #777;
        }
        /*body {
            font: 400 15px/1.8 Lato, sans-serif;
            color: #777;
        }*/
        h3, h4 {
            margin: 10px 0 30px 0;
            letter-spacing: 3px;
            font-size: 20px;
            color: #111;
        }
        .container {
            padding: 40px 20px;
        }
        * {box-sizing: border-box;}
        .formsearch {
            width: auto;
            float: right;
            margin-right: 30px;
            margin-top: 10px;
        }

        .searchinput{
            width: 250px;
            height: 30px;
            padding-left: 15px;
            border-radius: 42px;
            border: 2px solid #324b4e;
            background: #d3e0e9;
            outline: none;
            position: relative;
            transition: .3s linear;
        }
        .pageinput{
            #width: 250px;
            #height: 30px;
            padding-left: 15px;
            border-radius: 42px;
            border: 2px solid #324b4e;
            background: #ffffff;
            outline: none;
            position: relative;
            transition: .3s linear;
        }
        .searchinput:focus {
            width: 255px;
        }
        .search {
            width: 42px;
            height: 42px;
            background: none;
            border: none;
            position: absolute;
            top: 5px;
            right: 0;

        }
        .search:before{
            content: "\f002";
            font-family: FontAwesome;
            color: #ffffff;

        }

        .person {
            border: 10px solid transparent;
            margin-bottom: 25px;
            width: 80%;
            height: 80%;
            opacity: 0.7;
        }
        .person:hover {
            border-color: #f1f1f1;
        }
        .carousel-inner img {
            -webkit-filter: grayscale(1%);
            filter: grayscale(10%); /* make all photos black and white */
            width: 30%; /* Set width to 100% */
            margin: auto;
        }
        .carousel-caption h3 {
            color: #fff !important;
        }
        @media (max-width: 600px) {
            .carousel-caption {
                display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
            }
        }
        .bg-1 {
            background: #FFFFFF;
            color: #aa33ad;
        }
        .bg-1 h3 {color: #fff;}
        .bg-1 p {font-style: italic;}
        .list-group-item:first-child {
            border-top-right-radius: 0;
            border-top-left-radius: 0;
        }
        .list-group-item:last-child {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .thumbnail {
            padding: 0 0 15px 0;
            border: none;
            border-radius: 0;
        }
        .thumbnail p {
            margin-top: 15px;
            color: #213a1a;
        }
        .btn {
            padding: 10px 20px;
            background-color: #003366;
            color:  #cacaca;
            border-radius: 0;
            transition: .2s;
        }
        .btn:hover, .btn:focus {
            border: 1px solid #003366;
            background-color: #fff;
            color: #000;
        }
        .modal-header, h4, .close {
            background-color: #333;
            color: #fff !important;
            text-align: center;
            font-size: 30px;
        }
        .modal-header, .modal-body {
            padding: 40px 50px;
        }
        .nav-tabs li a {
            color: #213a1a;
        }
        #googleMap {
            width: 100%;
            height: 400px;
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
        }
       .navbar-header-logo{
            font-family: 'Lobster', sans-serif;
            font-size: 20px !important;
            background-color: #cccccc;

        }

        .navbar {
            font-family: Forum, sans-serif;
            margin-bottom: 0;


            background-color: #215D07;
            border: 0;
            font-size: 16px !important;
            letter-spacing: 4px;
            opacity: 0.9;
        }
        .navbar li a, .navbar .navbar-brand {
            color: #d5d5d5 !important;
            margin-top: 5px;
        }
        .navbar-nav li a:hover {
            color: #fff !important;
        }
        .navbar-nav li.active a {
            color: #fff !important;
            background-color: #213a1a !important;
        }
        .navbar-default .navbar-toggle {
            border-color: transparent;
        }
        .open .dropdown-toggle {
            color: #fff;
            background-color: #214c1a  !important;
        }
        .dropdown-menu li a {
            color: #000 !important;
        }
        .dropdown-menu li a:hover {
            background-color: #213a1a !important;
        }
        footer {
            background-color: #2d2d30;
            color: #f5f5f5;
            padding: 32px;
        }
        footer a {
            color: #f5f5f5;
        }
        footer a:hover {
            color: #213a1a;
            text-decoration: none;
        }
        .form-control {
            border-radius: 0;
        }
        textarea {
            resize: none;
        }
        .text-description-content.box-hide {
            overflow: hidden;
            max-height: 12em;
            position: relative;
        }
        .text-description-more-link {
            font-size: 1.30769em;
        }
        .text-description-content.box-hide:before {
            content: '';
            display: block;
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            height: 4em;
            background: -moz-linear-gradient(top,rgba(255,255,255,0) 0,#fff 100%);
            background: -webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(255,255,255,0)),color-stop(100%,#fff));
            background: -webkit-linear-gradient(top,rgba(255,255,255,0) 0,#fff 100%);
            background: -o-linear-gradient(top,rgba(255,255,255,0) 0,#fff 100%);
            background: -ms-linear-gradient(top,rgba(255,255,255,0) 0,#fff 100%);
            background: linear-gradient(top,rgba(255,255,255,0) 0,#fff 100%);
        }
        .text-description-content {
            padding-top: 2em;
        }
        .text-description-page {
            position: absolute;
            bottom: 22em;
            width: 100%;
            left: 0;
            color: #213a1a;
        }
        .text-description-more-link {
            font-size: 1.30769em;
        }

@yield('style')
    </style>
@yield('head')
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header-logo">
            <a class="navbar-brand" href="{{ url('/') }}">{{$logo_text}} </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>



        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <!-- Form SEARCH -->

                    <form class="formsearch" action="{{url('/search')}}" method="post">
                        {{ csrf_field() }}
                        <input class="searchinput"  type="search" name="textsearch" placeholder="Шукати програму...">
                        <button class="search" type="submit"></button>
                    </form>
                    <br />
                    <br />
                </li>

                <li>
                    <a href="{{url('/')}}">{{$index_link_text}}</a>
                </li>
                <li>
                    <a href="/archive">{{$closeprogram_link_text}}</a>


                </li>
                <li class="dropdown">
                    @if (Auth::guest())
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{$more_text_link}}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/login') }}">{{$enter_link_text}}</a></li>
                            <li><a href="{{ url('/register') }}">{{$register_link_text}}</a></li>
                            <li><a href="{{ url('/addadif') }}">{{$addlogsps_link_text}}</a></li>
                            @else
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ Auth::user()->name }}
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('cabinet')}}">{{$cabinet_link_text}}</a></li>
                                    <li><a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{$logout_link_text}}
                                        </a> <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
                                    @endif
                                </ul>


                        </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br />
@if (Auth::guest())
<div id="band" class="container text-center">
    <br />

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <!--ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <!--li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol-->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox" style="height: 200px">
        <div class="item active">
            <img src="image/Diplom90-2.jpg" alt="diplom 1"  width="100%">
            <div class="carousel-caption">

            </div>
        </div>

        <div class="item">
            <img src="image/73.jpg" alt="Diplom 2" width="100%" height="700">
            <div class="carousel-caption">

            </div>
        </div>

        <div class="item">
            <img src="image/rm110raem.jpg" alt="Diplom 3" width="100%" height="700">
            <div class="carousel-caption">

            </div>
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endif

<div id="contact" class="container">


        @yield('content')




</div>
</div>
<!-- Container (The Band Section) -->

<!-- Footer -->
<footer class="text-center">
    <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a><br><br>
    <p>The Wall - Diploma 2018 (c)  </p>
</footer>

<script>
    $(document).ready(function(){
        // Initialize Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {

                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    })
</script>


</body>
</html>

