<?php

namespace App\Services\Bitgo\Facades;

use App\Services\Bitgo\Contracts\WalletAddressInterface;
use Illuminate\Support\Facades\Facade;

class WalletAddress extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WalletAddressInterface::class;
    }
}
