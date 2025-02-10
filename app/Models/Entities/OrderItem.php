<?php

declare(strict_types=1);

namespace Models\Entities;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "order_items")]
class OrderItem
{
    #[DBColumn(isPK: true)]
    public int $id;
    #[DBColumn(name: 'order_id')]
    public int $orderId;
    #[DBColumn(name: 'drink_id')]
    public int $drinkId;
    public string $size;
    public int $quantity;
    public string $price;
}