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
    <script src="https://kit.fontawesome.com/af0df7a416.js" crossorigin="anonymous"></script>

</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0"
        nonce="MEgocOcP"></script>

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
    </div>
</nav>
<div class="headerimage_homepage">
    <img src="{{ asset('resources/images/bootje.jpg') }}">
</div>

<div id="weerinfo">
    <div class="container vertical-center">
        <div class="row">
            <div class="col-sm">
                {{ $station->icoonactueel['zin'] }}<br/>
                <img src="{{ $station->icoonactueel  }}">
            </div>
            <div class="col-sm">
                <stron>Temperatuur:</stron>
                <br/>
                <small>{{ $station->temperatuurGC }} &#x2103;</small>
            </div>
            <div class="col-sm">
                <strong>Wind:</strong><br/>
                <small>{{ $station->windsnelheidBF }} Bft - {{ $station->windrichting }}</small>
            </div>
            <div class="col-sm">
                <strong>Luchtvochtigheid:</strong><br/>
                <small>{{ $station->luchtvochtigheid }}&percnt;</small>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row mb-5">
        <div class="col-9">
            <div class="card mt-5">
                <div class="card-horizontal">
                    <div class="img-square-wrapper">
                        <img class="" src="http://via.placeholder.com/150x150" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <div id="newsTitle">Sportclinics 4 oktober in de Eendr8 gaan niet door</div>
                        <div id="newsDate">dinsdag 13 oktober 2020</div>
                        <p class="card-text">In verband met de aangekondigde corona maatregelen van het kabinet kunnen
                            de feestelijke activiteiten omtrent de opening van Sportcomplex De...</p>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-horizontal">
                    <div class="img-square-wrapper">
                        <img class="" src="http://via.placeholder.com/150x150" alt="Card image cap">
                    </div>
                    <div class="card-body newsText">
                        <div id="newsTitle">Aanmelden zwemmen komende dinsdag</div>
                        <div id="newsDate">dinsdag 10 oktober 2020</div>
                        <p class="card-text">U dient uw zoon/dochter/zichzelf uiterlijk zondagavond voor de
                            eerstvolgende zwemles aan te melden via de website. Meld je hieronder aan voor het....</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mt-5">
            <div class="fb-page" data-href="https://www.facebook.com/helvoetsereddingsbrigade/" data-tabs="timeline"
                 data-width="" data-height="" data-small-header="false" data-adapt-container-width="true"
                 data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/helvoetsereddingsbrigade/" class="fb-xfbml-parse-ignore"><a
                        href="https://www.facebook.com/helvoetsereddingsbrigade/">Helvoetse Reddingsbrigade</a>
                </blockquote>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center text-lg-start bg-light text-muted">
    <!-- Section: Social media -->
    <section
        class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
    >
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
            <span>Volg ons op Social Media:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-twitter"></i>
            </a>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-linkedin"></i>
            </a>
            </a>
        </div>
        <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Bij ALARM
                    </h6>
                    <p><i class="fas fa-phone me-3"></i> SPOED BEL 112</p>
                    <p><i class="fas fa-phone me-3"></i> Kustwacht: + 31 (0) 900 0111</p>
                    <p><i class="fas fa-phone me-3"></i> Reddingsbrigade: 0181 310 003</p>
                </div>

                <!-- Grid column -->


                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Belangrijke links
                    </h6>
                    <p>
                        <a href="#!" class="text-reset">Privacyverklaring</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Algemene voorwaarden</a>
                    </p>
                    <p>
                        <a href="#!" class="text-reset">Cookieverklaring</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Correspondentie
                    </h6>
                    <p><i class="fas fa-home me-3"></i> Postbus 202, 3220 AE Hellevoetsluis</p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        info@reddingsbrigade-hellevoetsluis.nl
                    </p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 1975 - {{ date("Y") }} Copyright:
        Helvoetse Reddingsbrigade
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
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
