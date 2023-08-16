<?php

// laravel-duplo/src/Duplo.php
/**
 * Duplo's B2B payment laravel package
 * @author Hope Chukwuemeka Ezenwa - Hopekell <hopekelltech@gmail.com>
 * @version 1.0
 **/

namespace HopekellDev\LaravelDuplo;

use HopekellDev\LaravelDuplo\Helpers\Checkout;
use HopekellDev\LaravelDuplo\Helpers\Customers;
use HopekellDev\LaravelDuplo\Helpers\Payment;
use HopekellDev\LaravelDuplo\Helpers\VirtualAccount;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Duplo
{
    protected $businessId;
    protected $apiKey;
    protected $apiUrl;
    protected $secreteHash;

    public function __construct()
    {
        $this->apiKey = config('duplo.api_key');
        $this->apiUrl = config('duplo.api_url');
        $this->businessId = config('duplo.business_id');
        $this->secreteHash = config('duplo.secret_hash');
    }

    /**
     * Generates a unique reference
     * @param $transactionPrefix
     * @return string
     */

     public function generateReference(String $transactionPrefix = NULL)
     {
         if ($transactionPrefix) {
             return $transactionPrefix . '_' . uniqid(time());
         }
         return 'dpl_' . uniqid(time());
     }


    /**
     * Wallet
     * @return Wallet
     */
    public function wallet()
    {
        $checkout = new Checkout($this->apiKey, $this->apiUrl, $this->businessId);
        return $checkout;
    }


    /**
     * Virtual Account
     * @return VirtualAccount
     */
    public function virtualAccount()
    {
        $virtual_account = new VirtualAccount($this->apiKey, $this->apiUrl, $this->businessId);
        return $virtual_account;
    }

    /**
     * Customers
     * @return Customers
     */
    public function customer()
    {
        $customer = new Customers($this->apiKey, $this->apiUrl, $this->businessId);
        return $customer;
    }


    /**
     * Payments
     * @return Payment
     */
    public function payment()
    {
        $payments = new Payment($this->apiKey, $this->apiUrl, $this->businessId);
        return $payments;
    }


    /**
     * Checkout
     * @return Checkout
     */
    public function checkout()
    {
        $checkout = new Checkout($this->apiKey, $this->apiUrl, $this->businessId);
        return $checkout;
    }


    /**
     * Handle Webhook
     */
    public function webhook(Request $request)
    {
        // If you specified a verify hash, check for the signature
        $verifyHash = $this->secreteHash;
        $signature = $request->header('DP_HASH_VERIFY');
        if (!$signature || ($signature !== $verifyHash)) {
            // This request isn't from Duplo; discard
            abort(401);
        }
        $payload = $request->all();
        // It's a good idea to log all received events.
        Log::info($payload);
        // Do something (that doesn't take too long) with the payload
        return [response(200), $payload];
    }
}
