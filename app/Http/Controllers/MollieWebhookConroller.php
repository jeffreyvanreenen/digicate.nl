<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;


class MollieWebhookConroller extends Controller
{
    public function handle(Request $request)
    {

        try {
            /*
             * Initialize the Mollie API library with your API key.
             *
             * See: https://www.mollie.com/dashboard/developers/api-keys
             */
            $mollie = new \Mollie\Api\MollieApiClient();
            if (env('MOLIE_STATUS') == 'test') {
                $mollie->setApiKey(env('MOLLIE_TEST_KEY'));
            } elseif (env('MOLIE_STATUS') == 'live') {
                $mollie->setApiKey(env('MOLLIE_KEY'));
            }

            /*
             * Retrieve the payment's current state.
             */
            $payment = $mollie->payments->get($_POST["id"]);
            $factuurid = $payment->metadata->factuurid;

            /*
             * Update the invoice in the database.
             */
            Invoice::where('id', $factuurid)->update(['status' => $payment->status]);

            if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
                /*
                 * The payment is paid and isn't refunded or charged back.
                 * At this point you'd probably want to start the process of delivering the product to the customer.
                 */

                Mail::to('jeffrey92.hrb@gmail.com')->send(new Notification());


            } elseif ($payment->isOpen()) {


            } elseif ($payment->isPending()) {


            } elseif ($payment->isFailed()) {


            } elseif ($payment->isExpired()) {


            } elseif ($payment->isCanceled()) {


            } elseif ($payment->hasRefunds()) {
                //Via Mollie terugbetaald

            } elseif ($payment->hasChargebacks()) {
                //Door gebruiker terug geboekt

            }
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }
}
