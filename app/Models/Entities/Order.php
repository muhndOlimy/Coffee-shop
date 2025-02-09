<?php

declare(strict_types=1);

namespace Models\Entities;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "orders")]
class Order
{
    #[DBColumn(isPK: true)]
    public int $id;
    #[DBColumn(name: 'user_id')]
    public int $userId;
    #[DBColumn(name: 'created_at', insert: false, update: false)]
    public string $createdAt;
    #[DBColumn(name: 'total_price')]
    public float $totalPrice;
}