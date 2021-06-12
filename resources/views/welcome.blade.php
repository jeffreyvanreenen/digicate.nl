<html>
<head>
    <title>{{ getenv('APP_NAME') }}</title>

    <!-- MAIN CSS -->
    <link href="{{ asset('css/main/main.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{ asset('css/main/main.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>--}}
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
    <a class="navbar-brand" href="#"><img src="{{ asset('resources/images/logo-hrb.png') }}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Doneren</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Vereniging</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Kalender</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Nieuws</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Inschrijven</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Zwemmen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Varend Redden</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>


            {{--                    <li class="nav-item dropdown">--}}
            {{--                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
            {{--                            Dropdown--}}
            {{--                        </a>--}}
            {{--                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
            {{--                            <a class="dropdown-item" href="#">Action</a>--}}
            {{--                            <a class="dropdown-item" href="#">Another action</a>--}}
            {{--                            <div class="dropdown-divider"></div>--}}
            {{--                            <a class="dropdown-item" href="#">Something else here</a>--}}
            {{--                        </div>--}}
            {{--                    </li>--}}
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Zoeken">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Zoeken</button>
        </form>
    </div>
</nav>
<div class="headerimage_homepage">
    <img src="{{ asset('resources/images/bootje.jpg') }}">
</div>

<div id="weerinfo">
    <div class="container vertical-center">
        <div class="row">
            <div class="col-sm">
                <img src="{{ $weerdata->weergegevens->actueel_weer->buienradar->icoonactueel }}"><br />{{ $weerdata->weergegevens->actueel_weer->buienradar->icoonactueel['zin'] }}

            </div>
            <div class="col-sm">
                One of three columns
            </div>
            <div class="col-sm">
                One of three columns
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</body>
</html>
