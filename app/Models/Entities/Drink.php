<?php

declare(strict_types=1);

namespace Models\Entities;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "drinks")]
class Drink
{
    #[DBColumn(isPK: true)]
    public int $id;
    public string $name;
    public string $image;
    #[DBColumn(name: 'category_id')]
    public int $categoryId;
    public string $description;
}