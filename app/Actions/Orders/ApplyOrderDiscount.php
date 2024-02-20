<?php

namespace App\Actions\Orders;

use App\Models\Order;
use App\Support\Values\Number;

class ApplyOrderDiscount
{
    public function run(Order $order, Number $discount): bool
    {
        return $order->update([
            'discount_amount' => $discount,
            'user_amount' => $order->amount->sub($discount),
        ]);
    }
}
