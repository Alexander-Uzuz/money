<?php

namespace App\Actions\Orders;

use App\Models\Order;
use App\Support\Values\Number;
use App\Actions\Orders\CreateOrderData;

class CreateOrderAction
{
    public function run(CreateOrderData $data): Order
    {
        return Order::query()->create([
            'amount' => $data->amount,
            'discount_amount' => new Number,
            'user_amount' => $data->amount,
        ]);
    }
}
