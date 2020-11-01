<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function buyVote(Request $request, $id)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $poll = Poll::find($id);
        if ($poll && $poll['author_id'] == auth()->user()->id) {
            return view('payment.boostVote.index', compact('id', 'snapToken'));
        }

        return redirect('home');
    }
}
