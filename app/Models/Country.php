<?php

declare(strict_types=1);

namespace Models;

use Configs\DBTable;

#[DBTable(name: "countries")]
class Country
{
    public int $id;
    public string $name;
}