<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class MollieWebhookConroller extends Controller
{
    public function handle(Request $request) {

        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_TEST_KEY'));
        $payment = $mollie->payments->get($_POST["id"]);
        $orderId = $payment->metadata->order_id;

        if (! $request->has('id')) {
            return;
        }

       // $payment = Mollie::api()->payments()->get($request->id);

        if ($payment->isPaid()) {
            // do your thing...
        }
    }
}
