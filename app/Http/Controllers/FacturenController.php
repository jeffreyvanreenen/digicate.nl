<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use phpDocumentor\Reflection\Types\Null_;
use App\Models\Invoice;
use App\Models\Factuurregel;

class FacturenController extends Controller
{
    private function Mollie_aanroepen()
    {
        $mollie = new \Mollie\Api\MollieApiClient();

        if(env('MOLIE_STATUS') == 'test') {
            $mollie->setApiKey(env('MOLLIE_TEST_KEY'));
        }elseif(env('MOLIE_STATUS') == 'live') {
            $mollie->setApiKey(env('MOLLIE_KEY'));
        }
        return $mollie;
    }

    public function index()
    {
        $mollie = new FacturenController();
        $mollie = $mollie->Mollie_aanroepen();

        //Klant aanmaken bij Mollie als deze nog niet is aangemaakt.
        $mollie_customer_id = Auth::user()->mollie_customer_id;
        if($mollie_customer_id == NULL){

            $customer = $mollie->customers->create([
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
            ]);

            $mollie_customer_id = $customer->id;
            $user =Auth::user();
            $user->mollie_customer_id = $mollie_customer_id;
            $user->save();
        }

        //Mandate ophalen bij Mollie als deze is aangemaakt
        $mollie_mandate_id = Auth::user()->mollie_mandate_id;
        if($mollie_mandate_id != NULL){
            $mollie_customer = $mollie->customers->get($mollie_customer_id);
            $mandate = $mollie_customer->getMandate($mollie_mandate_id);
        }else{
            $mandate = false;
        }

        $facturen = Invoice::where('user_id', '=', Auth::user()->id)->with('factuurregels')->orderBy('id', 'DESC')->get();





        return view('financieel.mijn_facturen')->with('mandate', $mandate)->with('facturen', $facturen);
    }

    public static function mandaat_afgeven()
    {
        $mollie = new FacturenController();
        $mollie = $mollie->Mollie_aanroepen();

        $mollie_customer_id = Auth::user()->mollie_customer_id;
        $mollie_mandate_id = Auth::user()->mollie_mandate_id;
        if($mollie_mandate_id == NULL){
            $mandate = $mollie->customers->get($mollie_customer_id)->createMandate([
                "method" => \Mollie\Api\Types\MandateMethod::DIRECTDEBIT,
                "consumerName" => Auth::user()->bank_rekeninghouder,
                "consumerAccount" => Auth::user()->bank_iban,
                "consumerBic" => Auth::user()->bank_bic,
                "signatureDate" => date("Y-m-d"),
                "mandateReference" => "HRB_".date("d-m-Y")."_".Auth::user()->id."_".Auth::user()->name,
        ]);
            $mollie_mandate_id = $mandate->id;
            $user =Auth::user();
            $user->mollie_mandate_id = $mollie_mandate_id;
            $user->save();
        }

        return redirect()->route('financieel.mijn_facturen');

    }

    public static function mandaat_intrekken()
    {
        $mollie = new FacturenController();
        $mollie = $mollie->Mollie_aanroepen();

        $mollie_customer_id = Auth::user()->mollie_customer_id;
        $mollie_mandate_id = Auth::user()->mollie_mandate_id;
        if($mollie_mandate_id != NULL){
            $customer = $mollie->customers->get($mollie_customer_id);
            $mandate = $customer->getMandate($mollie_mandate_id);
            $mandate->revoke();

            $user =Auth::user();
            $user->mollie_mandate_id = NULL;
            $user->save();
        }
        return redirect()->route('financieel.mijn_facturen');
    }

    public static function factuurbetalen($id)
    {
        $facturen = Invoice::where('user_id', '=', Auth::user()->id)
            ->where('id', '=', $id)
            ->with('factuurregels')
            ->first();

        if($facturen->status != 'open'){
            return redirect()->route('financieel.mijn_facturen');
        }

        $totaal = 0;

        foreach($facturen->factuurregels as $factuurregel) {
            $subtotaal = $factuurregel->aantal * $factuurregel->ppe;

            if ($factuurregel->btw == 21) {
                $subtotaal = $subtotaal * 1.21;
            }elseif ($factuurregel->btw == 9) {
                $subtotaal = $subtotaal * 1.09;
            }elseif ($factuurregel->btw == 0) {
                $subtotaal = $subtotaal * 1.00;
            }
            $totaal = $totaal + $subtotaal;
        }
        $totaal = number_format($totaal, 2, '.', '');

        $mollie = new FacturenController();
        $mollie = $mollie->Mollie_aanroepen();

        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $totaal,
            ],
            "description" => $facturen->factuurnummer." - ".$facturen->omschrijving,
            "customerId" => Auth::user()->mollie_customer_id,
            "redirectUrl" => "https://digicate.nl/financieel/mijn_facturen",
            "webhookUrl"  => "https://digicate.nl/webhooks/mollie",
        ]);

        $mollie_payment_id = $payment->id;


        $invoice = Invoice::find($id);
        $invoice->mollie_payment_id = $mollie_payment_id;
        $invoice->save();

        $payment_url = $payment->getCheckoutUrl();
        return redirect($payment_url);
    }

}
