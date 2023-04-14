<?php

namespace App\Http\Resources;

use App\Services\Bitgo\Facades\WalletAddress;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'wallet_id'  => $this->wallet_id,
            'bitgo_id'   => $this->bitgo_id,
            'wallet'     => $this->whenLoaded('wallet'),
            'address'    => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
