<?php

namespace App\Services\Bitgo;

use GuzzleHttp\Client;

class BitgoClient extends Client
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }
}

