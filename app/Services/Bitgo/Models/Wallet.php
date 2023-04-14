<?php

namespace App\Services\Bitgo\Models;

class Wallet
{
    public function __construct(
        public        readonly string $id,
        public        readonly string $label,
        public        readonly int $balance,
        public array  $addresses = [],
        public array  $users = [],
        public string $coin = '',
        public int    $m = 0,
        public int    $n = 0,
        public array  $keys = [],
    )
    {
    }

    public static function fromApiResponse(array $data): Wallet
    {
        return new Wallet(
            id: $data['id'],
            label: $data['label'],
            balance: $data['balance'],
            addresses: $data['addresses'] ?? [],
            users: $data['users'] ?? [],
            coin: $data['coin'] ?? '',
            m: $data['m'] ?? 0,
            n: $data['n'] ?? 0,
            keys: $data['keys'] ?? [],
        );
    }
}

