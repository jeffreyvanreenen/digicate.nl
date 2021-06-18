@extends('welcome')

@section('content')

    <div class="container" id="content">
        <div class="row mb-5 mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body contentText"> <div class="button_right_top">
                            @if(($factuur->status=='open'))
                                <a href="{{ route('mijnhrb.factuur_betalen', $factuur->id) }}"><button type="button" class="btn btn-primary">Betalen</button></a>
                            @endif
                            <a href="{{ route('mijnhrb.factuur_weergeven_plain', $factuur->id) }}"><button type="button" class="btn btn-primary">Downloaden</button></a>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Vraag stellen over deze factuur</button>
                        </div>

                        <!-- Modal -->
                        <form method="post" action="{{ route('mijnhrb.vraag_over_factuur', $factuur->id) }}">@csrf
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Vraag stellen over deze factuur</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea name="vraag" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Typ hier uw vraag..." required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                                        <button type="submit" class="btn btn-primary">Verstuur vraag</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

                        <h1>{{ __('Contributiefactuur # ') }} {{ $factuur->factuurnummer }}</h1>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <style>
                            .pagina {
                                position: relative;
                                width: 21cm;
                                min-height: 29.7cm;
                                padding: 2cm;
                                margin: 1cm auto;
                                border: 1px solid #eee;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                                border-radius: 5px;
                                font: 12pt "Calibri, sans-serif", serif;
                                background: white;
                            }

                            .header-blok {
                                width: 100%;
                            }

                            .header-blok .rechts {
                                width: auto;
                                float: right;
                            }

                            .header-blok .rechts td {

                                padding: 0px 0px 0px 30px;
                            }

                            .factuurtabel {
                                width: 100%;
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



                        <p><strong>Status:</strong></p>
                        <p>@if(($factuur->status=='open'))
                                Factuur is nog niet betaald. Klik <a href="{{ route('mijnhrb.factuur_betalen', $factuur->id) }}">hier</a> om de factuur direct te betalen.
                            @elseif(($factuur->status=='betaald'))
                                Factuur is betaald
                            @elseif(($factuur->status=='concept'))
                                Factuur is een concept. U hoeft deze nog niet te betalen.
                            @endif</p>
                        <div class="pagina">
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
                                    <td class="randjeboven" style="text-align: right">&euro; {{ number_format($totaal_excl_btw, 2, ',', '.') }}<br/>
                                        &euro; {{ number_format($btw_totaal, 2, ',', '.') }}<br/>
                                        <strong>&euro; {{ number_format($totaal, 2, ',', '.') }}</strong>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <p><strong>Factuurlog:</strong></p>
                        <p>
                        <ul>
                            @php(setlocale(LC_ALL, 'nld_nld'))
                            @forelse($factuur->factuurlog as $factuurlog)
                                @if($factuurlog->hide_for_user != 1)
                                    <li>{{ date("d-m-Y H:i", $factuurlog->tijd) }} - {{ $factuurlog->omschrijving }}</li>
                                @endif
                            @empty
                                <li>Geen log om weer te geven.</li>
                            @endforelse
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
