<?php

namespace HopekellDev\LaravelDuplo\Helpers;
use Illuminate\Support\Facades\Http;

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
}