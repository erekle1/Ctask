<?php

namespace App\Services\Bitgo\Models;

class WalletAddress
{
    public function __construct(
        public readonly string $id,
        public readonly string $address,
        public readonly int $chain,
        public readonly int $index,
        public readonly string $coin,
        public readonly string $wallet,
        public readonly array $coinSpecific = []
    )
    {
    }

    public static function fromApiResponse(array $data): WalletAddress
    {
        return new WalletAddress(
            id: $data['id'],
            address: $data['address'],
            chain: $data['chain'],
            index: $data['index'],
            coin: $data['coin'],
            wallet: $data['wallet'],
            coinSpecific: $data['coinSpecific'] ?? []
        );
    }
}

