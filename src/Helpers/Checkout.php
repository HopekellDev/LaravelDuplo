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

    public function __construct()
    {
        $this->apiKey = config('duplo.api_key');
        $this->apiUrl = config('duplo.api_url');
        $this->businessId = config('duplo.business_id');
    }


    /**
     * Generate checkout redirect url
     */
    public function generateUrl(array $data)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ];

        $data = array_merge($data, ['business_id' => $this->businessId]);
        $checkout_url = Http::withHeaders($headers)->post(
                $this->apiUrl .'/checkout',
                $data
            )->json();
                
            return $checkout_url;
    }
}