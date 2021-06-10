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

        try {
            /*
             * Initialize the Mollie API library with your API key.
             *
             * See: https://www.mollie.com/dashboard/developers/api-keys
             */
            $mollie = new MollieController();
            $mollie = $mollie->Mollie_aanroepen();

            /*
             * Retrieve the payment's current state.
             */
            $payment = $mollie->payments->get($_POST["id"]);
            $orderId = $payment->metadata->order_id;

            /*
             * Update the order in the database.
             */
            database_write($orderId, $payment->status);

            if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
                /*
                 * The payment is paid and isn't refunded or charged back.
                 * At this point you'd probably want to start the process of delivering the product to the customer.
                 */
            } elseif ($payment->isOpen()) {
                /*
                 * The payment is open.
                 */
            } elseif ($payment->isPending()) {
                /*
                 * The payment is pending.
                 */
            } elseif ($payment->isFailed()) {
                /*
                 * The payment has failed.
                 */
            } elseif ($payment->isExpired()) {
                /*
                 * The payment is expired.
                 */
            } elseif ($payment->isCanceled()) {
                /*
                 * The payment has been canceled.
                 */
            } elseif ($payment->hasRefunds()) {
                /*
                 * The payment has been (partially) refunded.
                 * The status of the payment is still "paid"
                 */
            } elseif ($payment->hasChargebacks()) {
                /*
                 * The payment has been (partially) charged back.
                 * The status of the payment is still "paid"
                 */
            }
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }


    }

    public function succes()
    {
        echo 'Gelukt!';
    }


}
