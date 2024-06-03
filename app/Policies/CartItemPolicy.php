<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CartItem;

class CartItemPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user, CartItem $cart_item)
    {
        return $user->id === $cart_item->user_id;
    }
}
