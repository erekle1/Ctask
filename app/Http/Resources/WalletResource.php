<?php

namespace App\Http\Resources;

use App\Services\Bitgo\Facades\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
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
            'user_id'    => $this->user_id,
            'bitgo_id'   => $this->bitgo_id,
            'label'      => $this->label,
            'addresses'  => $this->whenLoaded('addresses'),
            'bitgo'      => Wallet::getWalletById($this->bitgo_id),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
