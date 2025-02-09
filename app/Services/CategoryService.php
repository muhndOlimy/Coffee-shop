<?php

declare(strict_types=1);

namespace Services;

use Models\Entities\DrinkCategory;
use Repositories\Repository;

readonly class CategoryService
{
    /**
     * @param Repository<DrinkCategory> $categoryRepo
     */
    public function __construct(private Repository $categoryRepo)
    {
    }

    /** @return DrinkCategory[] */
    public function list(): array
    {
        return $this->categoryRepo->findAllBy();
    }
}
