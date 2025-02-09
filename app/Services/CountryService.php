<?php

declare(strict_types=1);

namespace Services;

use Models\Dtos\CountryWithStates;
use Models\Entities\Country;
use Models\Entities\State;
use Repositories\Repository;
use Utils\ArrayUtils;

readonly class CountryService
{
    /**
     * @param Repository<Country> $countryRepo
     * @param Repository<State> $stateRepo
     */
    public function __construct(private Repository $countryRepo,
                                private Repository $stateRepo)
    {
    }

    /** @return CountryWithStates[] */
    public function list(): array
    {
        $countries = $this->countryRepo->findAllBy();
        $states = ArrayUtils::groupBy($this->stateRepo->findAllBy(), fn($state) => $state->countryId);
        return array_map(function ($country) use ($states) {
            return new CountryWithStates($country, $states[$country->id] ?? []);
        }, $countries);
    }
}
