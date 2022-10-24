<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
// use Stripe\Error as Stripe;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     if ($e instanceof \Stripe\Exception\CardException || 
        //         get_class($e) == "Laravel\Cashier\Exceptions\IncompletePayment") {
                
        //         return redirect()->route('payment-request-'.session('locale'), ['order' => $request->order_id])->with('error', $e->getMessage());
        //     }

        //     // if (isset($body['error']['type']) && $body['error']['type'] == 'card_error') {
                
        //     // }
        // });
    }
}
