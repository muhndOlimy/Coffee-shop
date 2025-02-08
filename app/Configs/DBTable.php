<?php

declare(strict_types=1);

namespace Configs;

use Attribute;

#[Attribute]
class DBTable
{
    public function __construct(public string $name)
    {
    }
}