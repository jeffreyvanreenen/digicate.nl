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
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{ route('dashboard') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Mijn HRB
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('dashboard') }}">Overzicht</a>
            <a class="dropdown-item" href="{{ route('mijnhrb.mijn_facturen') }}">Mijn Facturen</a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="#">Mijn gegevens</a>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
    </li>
</ul>


