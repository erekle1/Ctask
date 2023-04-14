<?php

namespace App\Services\Bitgo\Facades;

use App\Services\Bitgo\Contracts\WalletInterface;
use Illuminate\Support\Facades\Facade;

class Wallet extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return WalletInterface::class;
    }
}
