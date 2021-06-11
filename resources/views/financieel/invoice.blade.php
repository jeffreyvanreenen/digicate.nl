<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mijn Facturen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <style>
                        .invoice-box {
                            margin: auto;
                            padding: 30px;
                            border: 1px solid #eee;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                            font-size: 16px;
                            line-height: 24px;
                            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                            color: #555;
                        }

                        .invoice-box table {
                            width: 100%;
                            line-height: inherit;
                            text-align: left;
                        }

                        .invoice-box table td {
                            padding: 5px;
                            vertical-align: top;
                        }

                        .invoice-box table tr.top table td.title {
                            font-size: 45px;
                            line-height: 45px;
                            color: #333;
                        }

                        .invoice-box table tr.information table td {
                            padding-bottom: 40px;
                        }

                        .invoice-box table tr.heading td {
                            background: #eee;
                            border-bottom: 1px solid #ddd;
                            font-weight: bold;
                        }

                        .invoice-box table tr.details td {
                            padding-bottom: 20px;
                        }

                        .invoice-box table tr.item td {
                            border-bottom: 1px solid #eee;
                        }

                        .invoice-box table tr.item.last td {
                            border-bottom: none;
                        }



                        @media only screen and (max-width: 600px) {
                            .invoice-box table tr.top table td {
                                width: 100%;
                                display: block;
                                text-align: center;
                            }

                            .invoice-box table tr.information table td {
                                width: 100%;
                                display: block;
                                text-align: center;
                            }
                        }
                    </style>
                    <div class="invoice-box">

                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{ asset('resources/images/logo-hrb.png') }}"
                                         style="width: 100%; max-width: 600px"/>
                                </td>
                                <td style="text-align: right">
                                    <strong>Factuur nummer:</strong> {{ $factuur->factuurnummer }}<br/>
                                        <strong>Factuurdatum:</strong> {{ date("d-m-Y", $factuur->factuurdatum) }}<br/>
                                            <strong>Vervaldatum:</strong> {{ date("d-m-Y", $factuur->vervaldatum) }}<br/>
                                </td>
                            </tr>
                        </table>

                        <table cellpadding="0" cellspacing="0">
                            <tr class="information">
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td><small>
                                                    <br /><br />
                                                    <h1>Factuur</h1>
                                                    <br />
                                                Helvoetse Reddingsbrigade<br/>
                                                Postbus 202<br/>
                                                3220 AE, Hellevoetsluis<br />
                                                </small> <p /><br /><br />
                                                {{ Auth::user()->name }}<br/>
                                                <small>{{ Auth::user()->email }}</small>
                                                <br /><br /><br />
                                                Betreft: {{ $factuur->omschrijving }}


                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

{{--                            <tr class="heading">--}}
{{--                                <td>Payment Method</td>--}}

{{--                                <td>Check #</td>--}}
{{--                            </tr>--}}

{{--                            <tr class="details">--}}
{{--                                <td>Check</td>--}}

{{--                                <td>1000</td>--}}
{{--                            </tr>--}}

                            <tr class="heading">
                                <td>Omschrijving</td>
                                <td>Aantal</td>
                                <td>Prijs per Eenheid</td>
                                <td>Eenheid</td>
                                <td>btw</td>

                                <td style="text-align: right">Prijs</td>
                            </tr>

                            @foreach($factuur->factuurregels as $factuurregel)

                                @php($subtotaal = $factuurregel->aantal * $factuurregel->ppe)

                                @if($factuurregel->btw == 21)
                                    @php($subtotaal = $subtotaal * 1.21)
                                @elseif($factuurregel->btw == 9)
                                    @php($subtotaal = $subtotaal * 1.09)
                                @endif

                            <tr class="item">
                                <td>{{ $factuurregel->omschrijving }}</td>
                                <td>{{ $factuurregel->aantal }}</td>
                                <td>{{ $factuurregel->ppe }}</td>
                                <td>PE</td>
                                <td>{{ $factuurregel->btw }} &percnt;</td>

                                <td style="text-align: right">&euro; {{ number_format($subtotaal, 2, ',', '.') }}</td>
                            </tr>
                            @endforeach



                            <tr class="total">
                                <td></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><strong>Totaal:</strong></td>
                                @php($totaal = 0)
                                {{--                                    $total = $factuur->factuurregels->sum('bedrag')--}}
                                @foreach($factuur->factuurregels as $factuurregel)
                                    @php($subtotaal = $factuurregel->aantal * $factuurregel->ppe)

                                    @if($factuurregel->btw == 21)
                                        @php($subtotaal = $subtotaal * 1.21)
                                    @elseif($factuurregel->btw == 9)
                                        @php($subtotaal = $subtotaal * 1.09)
                                    @endif

                                    @php($totaal = $totaal + $subtotaal)
                                @endforeach
                                <td style="text-align: right">&euro; {{ number_format($totaal, 2, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
