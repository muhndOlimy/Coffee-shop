<?php

declare(strict_types=1);

namespace Models\Dtos;

use Models\Entities\Country;
use Models\Entities\State;

readonly class CountryWithStates
{
    /** @param State[] $states */
    public function __construct(public Country $country, public array $states)
    {
    }
}