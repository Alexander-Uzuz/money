<?php

namespace App\Actions\Orders;

use App\Support\Values\Number;

class CreateOrderData
{
    public function __construct(
        public readonly Number $amount,
    ) {
    }
}
