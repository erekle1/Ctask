<?php

namespace App\Services\Bitgo\Enums;

enum WalletType: string
{
    case HOT = 'hot';
    case COLD = 'cold';
    case CUSTODIAL = 'custodial';
    case CUSTODIALPAIRED = 'custodialPaired';
    case TRADING = 'trading';
    // Add more coin types as needed
}
