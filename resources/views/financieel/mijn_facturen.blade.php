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

{{--                    {{ dd($mandate) }}--}}
                    @if($mandate == false)
                        U heeft nog geen SEPA-incassomachtiging afgegeven.
                        @if(Auth::user()->bank_rekeninghouder != NULL AND Auth::user()->bank_iban != NULL AND Auth::user()->bank_bic != NULL)
                            Klik <a href="{{ route('financieel.mandaat_afgeven') }}">hier</a> om een mandaat af te geven.
                        @else
                            U moet eerst uw betaalgegevens aanpassen om een machtiging af te kunnen geven.
                        @endif
                    @else
                        U heeft een SEPA-incassomachtiging afgegeven op {{ $mandate->signatureDate }} voor rekeningnummer {{ $mandate->details->consumerAccount }} ({{ $mandate->details->consumerName }}).

                        Klik <a href="{{ route('financieel.mandaat_intrekken') }}">hier</a> om de machtiging in te trekken.
                    @endif
                    <br /><br />

                    <table class="table">
                        <thead>
                        <tr>
                            <td><strong>Factuurnummer</strong></td>
                            <td><strong>Omschrijving</strong></td>
                            <td><strong>Factuurbedrag</strong></td>
                            <td><strong>Factuurdatum</strong></td>
                            <td><strong>Vervaldatum</strong></td>
                            <td><strong>Status</strong></td>
                            <td><strong>Opties</strong></td>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($facturen as $factuur)
                            <tr>
                                <td>{{ $factuur->factuurnummer }}</td>
                                <td>{{ $factuur->omschrijving }}</td>
{{--                                <td>{{ $factuur->factuurregels->omschrijving }}</td>--}}
                                <td>

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

                                    &euro; {{ number_format($totaal, 2, ',', '.') }}
                                </td>
                                <td>
                                    @if(($factuur->status!='concept'))
                                    {{ date ('d-m-Y', $factuur->factuurdatum) }}
                                    @endif
                                </td>
                                <td>
                                    @if(($factuur->status!='concept'))
                                    {{ date ('d-m-Y', $factuur->vervaldatum) }}
                                    @endif
                                </td>
                                <td>
                                    {{ ucfirst($factuur->status) }}
                                </td>
                                <td>
                                    @if(($factuur->status!='concept') and ($factuur->status!='betaald'))
                                        <a href="{{ route('financieel.factuur_betalen', $factuur->id) }}">Betalen</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Geen facturen</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>



                </div>
            </div>
        </div>
    </div>

</x-app-layout>
