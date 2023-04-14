<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WalletStoreRequest;
use App\Http\Resources\WalletResource;
use App\Models\Wallet as WalletModel;
use App\Services\Bitgo\Facades\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{

    public function index(Request $request)
    {
        $wallets = auth()->user()->wallets()->paginate();

        return WalletResource::collection($wallets);
    }


    public function show(Request $request, WalletModel $wallet)
    {
        $model = $request->get('withAddresses') == 1 ? $wallet->with('addresses')->first() : $wallet;

        return new WalletResource($model);
    }

    public function store(WalletStoreRequest $request): WalletResource
    {
        $bitgoWallet = Wallet::createWallet(label: $request->label, passphrase: $request->passphrase);

        $wallet = WalletModel::create([
            'user_id'  => auth()->id(),
            'bitgo_id' => $bitgoWallet->id,
            'label'    => $bitgoWallet->label,
        ]);

        return new WalletResource($wallet);
    }
}
