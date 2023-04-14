<?php

namespace App\Services\Bitgo\Services;

use App\Services\Bitgo\BitgoClient;
use App\Services\Bitgo\Contracts\WalletAddressInterface;
use App\Services\Bitgo\Enums\CoinType;
use App\Services\Bitgo\Models\WalletAddress;
use GuzzleHttp\Exception\GuzzleException;

class WalletAddressService implements WalletAddressInterface
{
    public function __construct(private BitgoClient $client, private $coin = CoinType::TBTC) {}

    public function createAddress(string $walletId): WalletAddress
    {
        try {

            $response = $this->client->post("{$this->coin->value}/wallet/{$walletId}/address");

            $addressData = json_decode($response->getBody()->getContents(), true);

            return WalletAddress::fromApiResponse($addressData);
        } catch (GuzzleException $e) {
            // Handle the exception or throw a custom exception
            throw $e;
        }
    }

    public function getAddresses(string $walletId): array
    {
        try {

            $response = $this->client->get("{$this->coin->value}/wallet/{$walletId}/addresses");

            $addressesData = json_decode($response->getBody()->getContents(), true)['addresses'];

            return array_map(fn ($addressData) => WalletAddress::fromApiResponse($addressData), $addressesData);
        } catch (GuzzleException $e) {
            // Handle the exception or throw a custom exception
            throw $e;
        }
    }

}
