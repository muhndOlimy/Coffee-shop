<?php

declare(strict_types=1);

namespace Models;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "states")]
class State
{
    public int $id;
    public string $name;
    #[DBColumn(name: "country_id")]
    public string $countryId;
}