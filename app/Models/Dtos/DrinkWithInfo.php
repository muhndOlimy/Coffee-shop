<?php

declare(strict_types=1);

namespace Models\Dtos;

use Models\Entities\Drink;
use Models\Entities\DrinkCategory;
use Models\Entities\DrinkSize;

readonly class DrinkWithInfo
{
    /** @param DrinkSize[] $sizes */
    public function __construct(public Drink         $drink,
                                public array         $sizes,
                                public DrinkCategory $category)
    {
    }
}