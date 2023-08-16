<?php

// laravel-duplo/config/duplo.php
/**
 * Duplo's B2B payment laravel package
 * @author Hope Chukwuemeka Ezenwa - Hopekell <hopekelltech@gmail.com>
 * @version 1.0
 **/

return [
    'api_key' => env('DUPLO_API_KEY', ''),
    'api_url' => env('DUPLO_API_URL', ''),
    'business_id' => env('DUPLO_BUSINESS_ID', ''),
];


