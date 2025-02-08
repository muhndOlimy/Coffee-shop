<?php

declare(strict_types=1);

namespace Models\Entities;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "states")]
class State
{
    #[DBColumn(isPK: true)]
    public int $id;
    public string $name;
    #[DBColumn(name: "country_id")]
    public int $countryId;
}