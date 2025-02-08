<?php

declare(strict_types=1);

namespace Configs;

use Attribute;

#[Attribute]
class DBColumn
{
    public function __construct(public ?string $name = null,
                                public ?bool   $isPK = false,
                                public ?bool   $insert = true,
                                public ?bool   $update = true)
    {
    }
}