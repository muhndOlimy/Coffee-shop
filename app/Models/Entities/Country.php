<?php

declare(strict_types=1);

namespace Models\Entities;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "countries")]
class Country
{
    #[DBColumn(isPK: true)]
    public int $id;
    public string $name;
}