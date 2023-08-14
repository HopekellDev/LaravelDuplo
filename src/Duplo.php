<?php

// laravel-duplo/src/Duplo.php

namespace HopekellDev\LaravelDuplo;

class Duplo
{
    protected $apiKey;
    protected $apiUrl;
    protected $businessId;

    public function __construct($apiKey, $apiUrl, $businessId)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
        $this->businessId = $businessId;
    }

    // Add methods to interact with Duplo endpoints here
}
