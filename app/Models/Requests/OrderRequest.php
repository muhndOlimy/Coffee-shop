<?php

declare(strict_types=1);

namespace Models\Requests;

class OrderRequest
{
    public int $drinkId;
    public string $size;
    public int $quantity;
}