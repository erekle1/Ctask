<?php

namespace App\Services\Bitgo\Contracts;

use App\Services\Bitgo\Models\Wallet;

interface WalletInterface
{
    public function createWallet(string $label, string $passphrase, $options = []): Wallet;

    public function getWallets(): array;

    public function getWalletById(string $walletId): Wallet;
}

