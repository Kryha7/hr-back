<?php

namespace App\Http\Controllers;

use App\PayPalTransaction;
use Illuminate\Http\Request;
use PayPal\Api\Payment;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class TransactionsController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $config = \Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential($config['client_id'], $config['secret']));
        $this->apiContext->setConfig($config['settings']);
    }

    public function index()
    {
        $transactions = PayPalTransaction::orderBy('id', 'desc')->get();
        return view('admin.transactions', compact('transactions'));
    }

    public function show(PayPalTransaction $transaction)
    {
        try{
            $payment = Payment::get($transaction->payment_id, $this->apiContext);
        } catch (Exception $ex){
            return 'error';
        }

        return view('admin.transaction.show', compact('payment'));
    }
}
