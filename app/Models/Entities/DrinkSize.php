<?php

declare(strict_types=1);

namespace Models\Entities;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "drink_sizes")]
class DrinkSize
{
    #[DBColumn(name: 'drink_id', isPK: true)]
    public int $drinkId;
    #[DBColumn(isPK: true)]
    public string $size;
    public string $price;
    #[DBColumn(name: 'price_promo')]
    public ?string $pricePromo;
}