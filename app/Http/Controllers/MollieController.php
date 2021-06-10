<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MollieController extends Controller
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

    public static function NieuweFactuur(){

        $mollie = new MollieController();
        $mollie = $mollie->Mollie_aanroepen();

        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => "10.00"
            ],
            "description" => "Inschrijfgeld Helvoetse Reddingsbrigade",
            "redirectUrl" => "https://digicate.nl/succes",
            "webhookUrl"  => "https://digicate.nl/webhooks/mollie",
        ]);


        $payment = $payment->getCheckoutUrl();

        return redirect($payment);

    }

    public static function StatusBetaling($id){

        $mollie = new MollieController();
        $mollie = $mollie->Mollie_aanroepen();

        $payment = $mollie->payments->get($id);

        if ($payment->isPaid())
        {
            echo "Payment received.";
        }

    }

    public static function Webhook()
    {




    }

    public function succes()
    {
        echo 'Gelukt!';
    }


}
