<?php

namespace App\Services\Bitgo\Services;

use App\Services\Bitgo\BitgoClient;
use App\Services\Bitgo\Contracts\WalletInterface;
use App\Services\Bitgo\Enums\CoinType;
use App\Services\Bitgo\Models\Wallet;
use GuzzleHttp\Exception\GuzzleException;


class WalletService implements WalletInterface
{
    public function __construct(private readonly BitgoClient $client, private $coin = CoinType::TBTC,)
    {

    }


    public function createWallet(string $label, string $passphrase, $options = []): Wallet
    {
        try {
            $payload['label'] = $label;
            $payload['passphrase'] = $passphrase;
            $payload = array_merge($payload, $options);

            $response = $this->client->post("{$this->coin->value}/wallet/generate", [
                'json' => $payload,
            ]);

            $walletData = json_decode($response->getBody()->getContents(), true);

            return Wallet::fromApiResponse($walletData);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
            // Handle the exception or throw a custom exception
            throw $e;
        }
    }

    public function getWallets(): array
    {
        try {

            $response = $this->client->get("{$this->coin->value}/wallet");

            $walletsData = json_decode($response->getBody()->getContents(), true)['wallets'];

            return array_map(fn($walletData) => Wallet::fromApiResponse($walletData), $walletsData);
        } catch (GuzzleException $e) {
            // Handle the exception or throw a custom exception
            throw $e;
        }
    }

    public function getWalletById(string $walletId): Wallet
    {

        try {

            $response = $this->client->get("{$this->coin->value}/wallet/{$walletId}");

            $walletData = json_decode($response->getBody()->getContents(), true);

            return Wallet::fromApiResponse($walletData);
        } catch (GuzzleException $e) {
            // Handle the exception or throw a custom exception
            throw $e;
        }
    }
}
