<?php

namespace HopekellDev\LaravelDuplo\Helpers;
use Illuminate\Support\Facades\Http;

/**
 * Duplo's B2B payment laravel package
 * @author Hope Chukwuemeka Ezenwa - Hopekell <hopekelltech@gmail.com>
 * @version 1.0
 **/
class Invoices
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
}