<?php

namespace HopekellDev\LaravelDuplo\Helpers;
use Illuminate\Support\Facades\Http;

/**
 * Duplo's B2B payment laravel package
 * @author Hope Chukwuemeka Ezenwa - Hopekell <hopekelltech@gmail.com>
 * @version 1.0
 **/
class Customers
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
     * Create customer
     */
    public function createCustomer(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $data = array_merge($data, ['business_id' => $this->businessId]);
        $customer = Http::withHeaders($headers)->post(
                $this->apiUrl .'/wallets/customers',
                $data
            )->json();
                
        return $customer;
    }


    /**
     * List all customer
     */
    public function listCustomer()
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $all_customers = Http::withHeaders($headers)->get(
                $this->apiUrl .'/wallets/customers?business_id=' . $this->businessId
            )->json();
                
        return $all_customers;
    }


    /**
     * Get customer details
     */
    public function getCustomer(string $customer_ref)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $account = Http::withHeaders($headers)->get(
                $this->apiUrl .'/wallets/customers/:'.$customer_ref.'?business_id=' . $this->businessId
            )->json();
                
        return $account;
    }
}