<html>
<head>
    <title>{{ getenv('APP_NAME') }}</title>

    <!-- MAIN CSS -->
    <link href="{{ asset('css/main/main.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

{{--    <link href="{{ asset('css/main/main.css') }}" rel="stylesheet" type="text/css"/>--}}

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>--}}
    <script src="https://kit.fontawesome.com/af0df7a416.js" crossorigin="anonymous"></script>

    <style>
        body {
            margin:0;
            background-color:#f4f2ee;
            font: 10pt "Calibri, sans-serif", serif;
            color:#000000;
            font-weight:normal;
        }

        .pagina {
            position: absolute;
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: 0;
            border: 1px solid #eee;
            font: 10pt "Calibri, sans-serif", serif;
            background: white;
        }
        @page { margin: 0; }

        .header-blok {
            width: 17cm;
            position: relative;
            margin: 0;
        }

        .header-blok .rechts {
            width: auto;
            float: right;
        }

        .header-blok .rechts td {
            padding: 0px 0px 0px 30px;
        }

        .factuurtabel {
            width: 17cm;
            position: relative;
            margin: 0;
        }

        .introtekst {
            width: 17cm;
            position: relative;
            margin: 0;
        }

        .factuurtabel td {
            padding: 10px;
        }

        .factuurtabel td .nopadding {
            padding: 10px;
        }

        .factuurtabel thead {
            border-bottom: 2px solid #C1C1C1;
            border-top: 2px solid #C1C1C1;
            padding: 15px;
        }

        .factuurtabel .randjeboven {
            border-top: 1px solid #C1C1C1;
        }

    </style>
</head>
<body>
<div id="main">
    <div class="pagina" id="printarea">
        <img src="{{ asset('resources/images/logo-hrb.png') }}"
             style="width: 100%; max-width: 400px"/>

        <p>&nbsp;</p>

        <table class="header-blok">
            <tr>
                <td valign="top">
                    <table cellspacing="0" cellpadding="0">
                        <tr>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td>{{ Auth::user()->adres }}</td>
                        </tr>
                        <tr>
                            <td>{{ Auth::user()->postcode }}, {{ Auth::user()->woonplaats }}</td>
                        </tr>

                    </table>
                </td>
                <td valign="top">
                    <table class="rechts" cellspacing="300" cellpadding="0">
                        <tr>
                            <td>Lidnummer:</td>
                            <td>{{ Auth::user()->lidnummer }}</td>
                        </tr>
                        <tr>
                            <td>Factuurnummer:</td>
                            <td>{{ $factuur->factuurnummer }}</td>
                        </tr>
                        <tr>
                            <td>Datum:</td>
                            <td>{{ date("d-m-Y", $factuur->factuurdatum) }}</td>
                        </tr>
                        <tr>
                            <td>Vervaldatum:</td>
                            <td>{{ date("d-m-Y", $factuur->vervaldatum) }}</td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        <br/><br/>
        <div class="introtekst">
        <p>Geachte {{ Auth::user()->name }},</p>
        <p>Hierbij ontvangt u de factuur voor onderstaande contributies en/of verenigingsgelden.
            Wij ontvangen het bedrag graag binnen de gestelde betaaltermijn op bankrekening NL70 INGB
            0003 5896 03 ten name van Helvoetse Reddingsbrigade onder vermelding van uitsluitend
            lidnummer en factuurnummer: {{ Auth::user()->lidnummer }}-{{ $factuur->factuurnummer }}.
            Wilt u voor tijdige betaling zorgdragen?
        </p>
        <p>Wij vertrouwen erop u hiermee voldoende te hebben geïnformeerd. Indien u nog vragen heeft,
            vernemen wij deze graag op emailadres: penningmeester@reddingsbrigade-hellevoetsluis.nl.</p>
        <p>Met vriendelijke groet,<br/>namens het bestuur,<br/><br/>Jeffrey van Reenen<br/>Penningmeester
        </p>
        </div>
        <br/>
        <table class="factuurtabel">
            <thead>
            <tr>
                <td>Omschrijving</td>
                <td>Aantal</td>
                <td>PPE</td>
                <td>Eenheid</td>
                <td>Btw</td>
                <td>Totaal</td>
            </tr>
            </thead>
            <tbody>
            @foreach($factuur->factuurregels as $factuurregel)

                @php($subtotaal = $factuurregel->aantal * $factuurregel->ppe)

                @if($factuurregel->btw == 21)
                    @php($subtotaal = $subtotaal * 1.21)
                @elseif($factuurregel->btw == 9)
                    @php($subtotaal = $subtotaal * 1.09)
                @endif

                <tr>
                    <td>{{ $factuurregel->omschrijving }}</td>
                    <td>{{ $factuurregel->aantal }}</td>
                    <td>&euro; {{ number_format($factuurregel->ppe, 2, ',', '.') }}</td>
                    <td>PE</td>
                    <td>{{ $factuurregel->btw }} &percnt;</td>

                    <td style="text-align: right">
                        &euro; {{ number_format($subtotaal, 2, ',', '.') }}</td>
                </tr>
            @endforeach

            {{--                                Totaal berekenen --}}
            @php($totaal = 0)
            @foreach($factuur->factuurregels as $factuurregel)

                @php($subtotaal = $factuurregel->aantal * $factuurregel->ppe)

                @if($factuurregel->btw == 21)
                    @php($subtotaal = $subtotaal * 1.21)
                @elseif($factuurregel->btw == 9)
                    @php($subtotaal = $subtotaal * 1.09)
                @endif

                @php($totaal = $totaal + $subtotaal)

            @endforeach
            {{--                                Subtotaal exclusief BTW berekenen --}}

            @php($totaal_excl_btw = 0)
            @foreach($factuur->factuurregels as $factuurregel)

                @php($subtotaal_excl_btw = $factuurregel->aantal * $factuurregel->ppe)

                @php($totaal_excl_btw = $totaal_excl_btw + $subtotaal_excl_btw)

            @endforeach

            @php($btw_totaal = $totaal - $totaal_excl_btw)

            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="randjeboven">Subtotaal:<br/>
                    btw:<br/>
                    <strong>Factuurbedrag:</strong></td>
                <td class="randjeboven" style="text-align: right">
                    &euro; {{ number_format($totaal_excl_btw, 2, ',', '.') }}<br/>
                    &euro; {{ number_format($btw_totaal, 2, ',', '.') }}<br/>
                    <strong>&euro; {{ number_format($totaal, 2, ',', '.') }}</strong>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
</body>
</htmL>
