<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Services\PayPalService;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class PayPalController extends Controller
{
    protected PayPalService $paypal;

    public function __construct(PayPalService $paypal)
    {
        $this->paypal = $paypal;
    }

    // Step 1: Create order and redirect to PayPal
    public function pay(Request $request)
    {
        $bookingId = $request->booking_id;
        $booking = Booking::findOrFail($bookingId);

        $requestOrder = new OrdersCreateRequest();
        $requestOrder->prefer('return=representation');
        $requestOrder->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($booking->total_amount, 2, '.', ''),
                    ],
                    "description" => "Payment for Booking #{$booking->id}"
                ]
            ],
            "application_context" => [
                "cancel_url" => url('/paypal/cancel'),
                "return_url" => url('/paypal/success?booking_id=' . $booking->id),
            ]
        ];

        try {
            $response = $this->paypal->getClient()->execute($requestOrder);

            foreach ($response->result->links as $link) {
                if ($link->rel === 'approve') {
                    return redirect()->away($link->href);
                }
            }

            return back()->withErrors('Could not redirect to PayPal.');
        } catch (\Exception $ex) {
            return back()->withErrors('PayPal error: ' . $ex->getMessage());
        }
    }

    // Step 2: Capture order after approval
    public function success(Request $request)
    {
        $bookingId = $request->get('booking_id');
        $token = $request->get('token');

        $booking = Booking::findOrFail($bookingId);

        $captureRequest = new OrdersCaptureRequest($token);
        $captureRequest->prefer('return=representation');

        try {
            $response = $this->paypal->getClient()->execute($captureRequest);

            if ($response->statusCode === 201) {

                $booking->status = 'confirmed';
                $booking->save();


                $booking->event->decrement('available_seats', $booking->tickets);

                return redirect()->route('bookings.index')->with('success', 'Payment Successful!');
            }

            return redirect()->route('bookings.index')->withErrors('Payment capture failed.');
        } catch (\Exception $ex) {
            return redirect()->route('bookings.index')->withErrors('PayPal capture error: ' . $ex->getMessage());
        }
    }


    public function cancel()
    {
        return redirect()->route('bookings.index')->with('error', 'Payment cancelled.');
    }
}
