<?php

declare(strict_types=1);

namespace Models\Entities;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "user_favourite_categories")]
class UserFavouriteCategory
{
    #[DBColumn(name: 'user_id', isPK: true)]
    public int $userId;
    #[DBColumn(name: 'category_id', isPK: true)]
    public int $categoryId;
}