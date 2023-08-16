<?php

namespace HopekellDev\LaravelDuplo\Helpers;
use Illuminate\Support\Facades\Http;

/**
 * Duplo's B2B payment laravel package
 * @author Hope Chukwuemeka Ezenwa - Hopekell <hopekelltech@gmail.com>
 * @version 1.0
 **/
class Payment
{
    
    protected $apiKey;
    protected $apiUrl;
    protected $businessId;

    public function __construct(string $apiKey, string $apiUrl, string $businessId)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
        $this->businessId = $businessId;
    }

    /**
     * Request OTP to initiate payout
     */
    public function requestOtp()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $otp = Http::withHeaders($headers)->post(
                $this->apiUrl .'/recipients/payouts-otp',
                $this->businessId
            )->json();
                
        return $otp;
    }


    /**
     * Get bank list
     */
    public function getBanks($country)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $otp = Http::withHeaders($headers)->get(
                $this->apiUrl .'/merchants/utilities/banks/list?country=' . $country
            )->json();
                
        return $otp;
    }

    /**
     * Get wallet balance
     */
    public function getBalance($wallet_ref)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ];

        $balance = Http::withHeaders($headers)->get(
                $this->apiUrl . '/wallets/balance/'. $wallet_ref . $this->businessId
            )->json();
    }


    /**
     * Account lookup
     */
    public function verifyAccount(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ];

        $data = array_merge($data, ['business_id' => $this->businessId]);
        $balance = Http::withHeaders($headers)->post(
                $this->apiUrl . '/merchants/utilities/banks/verify',
                $data
            )->json();

        return $balance;
    }


    /**
     * Initiate Payout/Transfer
     */
    public function initiateTransfer(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ];

        $data = array_merge($data, ['business_id' => $this->businessId]);
        $transfer = Http::withHeaders($headers)->post(
                $this->apiUrl . '/wallets/transfer',
                $data
            )->json();

        return $transfer;
    }


    /**
     * Get all transactions
     */
    public function getTransactions(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ];
        $data = array_merge($data, ['business_id' => $this->businessId]);
        $balance = Http::withHeaders($headers)->get(
            $this->apiUrl . '/wallets/transactions?'. http_build_query($data)
        )->json();

        return $balance;
    }


    /**
     * Get details of a transaction
     */
    public function transactionDetails(string $tx_ref)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ];
        $tx_details = Http::withHeaders($headers)->get(
            $this->apiUrl . '/wallets/transactions/:' . $tx_ref
        )->json();

        return $tx_details;
    }


    /**
     * Retry transfer
     */
    public function retryTransfer($tx_ref)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ];
        $transfer = Http::withHeaders($headers)->post(
            $this->apiUrl . '/wallets/retry-transfer/' . $tx_ref
        )->json();

        return $transfer;
    }
}