<?php

namespace App\Services\Bitgo\Contracts;

use App\Services\Bitgo\Models\WalletAddress;

interface WalletAddressInterface
{
    public function createAddress(string $walletId): WalletAddress;
    public function getAddresses(string $walletId): array;
}
