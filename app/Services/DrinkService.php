<?php

declare(strict_types=1);

namespace Services;

use Models\Dtos\DrinkWithInfo;
use Models\Entities\Drink;
use Models\Entities\DrinkCategory;
use Models\Entities\DrinkSize;
use Repositories\Repository;
use Utils\ArrayUtils;

readonly class DrinkService
{
    /**
     * @param Repository<Drink> $drinkRepo
     * @param Repository<DrinkSize> $sizeRepo
     * @param Repository<DrinkCategory> $categoryRepo
     */
    public function __construct(private Repository $drinkRepo,
                                private Repository $sizeRepo,
                                private Repository $categoryRepo)
    {
    }

    /** @return DrinkWithInfo[] */
    public function list(): array
    {
        $drinks = $this->drinkRepo->findAllBy();
        $categories = ArrayUtils::groupBy($this->categoryRepo->findAllBy(), fn($category) => $category->id);
        $sizes = ArrayUtils::groupBy($this->sizeRepo->findAllBy(), fn($size) => $size->drinkId);
        return array_map(function ($drink) use ($sizes, $categories) {
            return new DrinkWithInfo($drink, $sizes[$drink->id] ?? [], $categories[$drink->categoryId]);
        }, $drinks);
    }
}
