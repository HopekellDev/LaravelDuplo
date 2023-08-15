<?php

namespace HopekellDev\LaravelDuplo\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class VirtualAccount
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
     * Create a virtual account
     */
    public function create(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $account = Http::withHeaders($headers)->post(
                $this->apiUrl .'/virtual-accounts',
                $data
            )->json();
                
        return $account;
    }

    /**
     * Update a virtual account
     */
    public function update(array $data, string $ref)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $account = Http::withHeaders($headers)->patch(
                $this->apiUrl .'/virtual-accounts/:'.$ref.'?business_id=' . $this->businessId,
                $data
            )->json();
                
        return $account;
    }

    /**
     * Delete a virtual account
     */
    public function delete(string $account_ref)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $account = Http::withHeaders($headers)->delete(
                $this->apiUrl .'/virtual-accounts/:' . $account_ref
            )->json();
                
        return $account;
    }


    /**
     * List all virtual accounts
     */
    public function listVirtualAccounts()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $accounts = Http::withHeaders($headers)->get(
                $this->apiUrl .'/virtual-accounts?'
            )->json();
                
        return $accounts;
    }


    /**
     * Get virtual account details
     */
    public function accountDetails(string $account_ref)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $account = Http::withHeaders($headers)->get(
                $this->apiUrl .'/virtual-accounts/:'.$account_ref
            )->json();
                
        return $account;
    }
}