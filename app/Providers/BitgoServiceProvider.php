<?php

namespace App\Providers;

use App\Services\Bitgo\BitgoClient;
use App\Services\Bitgo\Contracts\WalletAddressInterface;
use App\Services\Bitgo\Contracts\WalletInterface;
use App\Services\Bitgo\Facades\Wallet;
use App\Services\Bitgo\Facades\WalletAddress;
use App\Services\Bitgo\Services\WalletAddressService;
use App\Services\Bitgo\Services\WalletService;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class BitgoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BitgoClient::class, function ($app) {
            return new BitgoClient([
                'base_uri' => $app['config']['bitgo.api_url'],
                'headers'  => [
                    'Authorization' => 'Bearer ' . $app['config']['bitgo.access_token'],
                    'Content-Type'  => 'application/json',
                ],
            ]);
        });

        $this->app->when(WalletService::class)
            ->needs(BitgoClient::class)
            ->give(function () {
                return new BitgoClient([
                    'base_uri' => config('bitgo.express_host') . ":" . config('bitgo.express_port')."/api/v2/",
                    'headers'  => [
                        'Authorization' => 'Bearer ' . config('bitgo.access_token'),
                        'Content-Type'  => 'application/json',
                    ],
                ]);
            });


        $this->app->bind(WalletInterface::class, WalletService::class);
        $this->app->bind(WalletAddressInterface::class, WalletAddressService::class);

        $this->app->alias(WalletInterface::class, 'wallet');
        $this->app->alias(WalletAddressInterface::class, 'wallet-address');

        // Register the facades
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Wallet', Wallet::class);
            $loader->alias('WalletAddress', WalletAddress::class);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
