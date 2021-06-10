<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MollieWebhookConroller extends Controller
{
    public function handle(Request $request) {
        if (! $request->has('id')) {
            return;
        }

        $payment = Mollie::api()->payments()->get($request->id);

        if ($payment->isPaid()) {
            // do your thing...
        }
    }
}
