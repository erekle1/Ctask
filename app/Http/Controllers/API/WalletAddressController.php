<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\WalletAddressStoreRequest;
use App\Http\Resources\WalletAddressResource;
use App\Models\Wallet;
use App\Models\WalletAddress as WalletAddressModel;
use App\Services\Bitgo\Facades\WalletAddress;
use Illuminate\Http\Request;


class WalletAddressController extends Controller
{

    public function index(Request $request)
    {
        $addresses = WalletAddressModel::paginate();

        return WalletAddressResource::collection($addresses);
    }


    public function store(WalletAddressStoreRequest $request, Wallet $wallet)
    {

        $bitgoAddress = WalletAddress::createAddress($wallet->bitgo_id, $request->label);

        $address = WalletAddressModel::create([
            'wallet_id' => $wallet->id,
            'bitgo_id'  => $bitgoAddress->id,
            'address'   => $bitgoAddress->address,
        ]);

        return new WalletAddressResource($address);
    }
}
