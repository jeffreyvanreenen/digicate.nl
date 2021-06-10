<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;


class MollieWebhookConroller extends Controller
{
    public function handle(Request $request) {

        try {
            /*
             * Initialize the Mollie API library with your API key.
             *
             * See: https://www.mollie.com/dashboard/developers/api-keys
             */
            $mollie = new \Mollie\Api\MollieApiClient();
            if(env('MOLIE_STATUS') == 'test') {
                $mollie->setApiKey(env('MOLLIE_TEST_KEY'));
            }elseif(env('MOLIE_STATUS') == 'live') {
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
            //database_write($orderId, $payment->status);

            if ($payment->isPaid() && ! $payment->hasRefunds() && ! $payment->hasChargebacks()) {
                /*
                 * The payment is paid and isn't refunded or charged back.
                 * At this point you'd probably want to start the process of delivering the product to the customer.
                 */
                
            } elseif ($payment->isOpen()) {

                $id = $_POST["id"];
                Invoice::where('mollie_payment_id', $id)->update(['status' => 'open']);

            } elseif ($payment->isPending()) {

                $id = $_POST["id"];
                Invoice::where('mollie_payment_id', $id)->update(['status' => 'pending']);

            } elseif ($payment->isFailed()) {

                $id = $_POST["id"];
                Invoice::where('mollie_payment_id', $id)->update(['status' => 'open']);

            } elseif ($payment->isExpired()) {

                $id = $_POST["id"];
                Invoice::where('mollie_payment_id', $id)->update(['status' => 'open']);

            } elseif ($payment->isCanceled()) {

                $id = $_POST["id"];
                Invoice::where('mollie_payment_id', $id)->update(['status' => 'open']);

            } elseif ($payment->hasRefunds()) {
                //Via Mollie terugbetaald
                $id = $_POST["id"];
                Invoice::where('mollie_payment_id', $id)->update(['status' => 'gecrediteerd']);

            } elseif ($payment->hasChargebacks()) {

                $id = $_POST["id"];
                Invoice::where('mollie_payment_id', $id)->update(['status' => 'open']);

            }
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }
}
