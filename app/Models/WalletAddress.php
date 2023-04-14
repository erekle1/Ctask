<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletAddress extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_id', 'bitgo_id', 'address'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }


}
