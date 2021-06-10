<?php

namespace App\Http\Controllers;

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
            $mollie->setApiKey(env('MOLLIE_TEST_KEY'));

            /*
             * Retrieve the payment's current state.
             */
            $payment = $mollie->payments->get($_POST["id"]);
            //$orderId = $payment->metadata->order_id;

            /*
             * Update the order in the database.
             */
            //database_write($orderId, $payment->status);

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



    public function handmatig($id) {

        try {
            /*
             * Initialize the Mollie API library with your API key.
             *
             * See: https://www.mollie.com/dashboard/developers/api-keys
             */
            $mollie = new \Mollie\Api\MollieApiClient();
            $mollie->setApiKey(env('MOLLIE_TEST_KEY'));

            /*
             * Retrieve the payment's current state.
             */
            $payment = $mollie->payments->get($id);
            //$orderId = $payment->metadata->order_id;

            /*
             * Update the order in the database.
             */
            //database_write($orderId, $payment->status);

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
                echo 'failed';
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
}
