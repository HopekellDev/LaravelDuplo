<?php

namespace HopekellDev\LaravelDuplo\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

/**
 * Duplo's B2B payment laravel package
 * @author Hope Chukwuemeka Ezenwa - Hopekell <hopekelltech@gmail.com>
 * @version 1.0
 **/
class Checkout
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
     * Get a list of all digital wallets
     */
    public function listWallets(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $data = array_merge($data, ['business_id' => $this->businessId]);
        $wallet = Http::withHeaders($headers)->get(
                $this->apiUrl .'/wallets?bvn='.$data['bvn'].'&perPage='.$data['perPage'].'&business_id='.$data['business_id']
            )->json();
                
        return $wallet;
    }


    /**
     * Create a digital wallet
     */
    public function createWallet(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $data = array_merge($data, ['business_id' => $this->businessId]);
        $wallet = Http::withHeaders($headers)->post(
                $this->apiUrl .'/wallets',
                $data
            )->json();
                
        return $wallet;
    }


    /**
     * Get digital wallet details
     */
    public function getWallet(string $wallet_ref)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $wallet = Http::withHeaders($headers)->get(
                $this->apiUrl .'/wallets/:'.
                $wallet_ref
            )->json();
                
        return $wallet;
    }


    /**
     * Move money between two digital wallets
     */
    public function transferToP2p(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $data = array_merge($data, ['business_id' => $this->businessId]);
        $transfer = Http::withHeaders($headers)->post(
                $this->apiUrl .'/wallets/transfer-p2p',
                $data
            )->json();
                
        return $transfer;
    }


    /**
     * Move money from a digital wallet to 
     * your business balance.
     */
    public function withdraw(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $data = array_merge($data, ['business_id' => $this->businessId]);
        $withdraw = Http::withHeaders($headers)->post(
                $this->apiUrl .'/wallets/merchant-withdrawal',
                $data
            )->json();
                
        return $withdraw;
    }


    /**
     * Move money from multiple digital wallets to 
     * your business balance.
     */
    public function sweepBalances(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $data = array_merge($data, ['business_id' => $this->businessId]);
        $sweep = Http::withHeaders($headers)->post(
                $this->apiUrl .'/wallets/multiple-merchant-withdrawal',
                $data
            )->json();
                
        return $sweep;
    }


    /**
     * Get the available and ledger balances of a digital walle
     */
    public function getBalance(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $balance = Http::withHeaders($headers)->get(
                $this->apiUrl .'/:'. $data['wallet_ref'] . '?business_id=' . $this->businessId
            )->json();
                
        return $balance;
    }
}