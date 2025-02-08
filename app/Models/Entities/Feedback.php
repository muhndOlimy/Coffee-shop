<?php

declare(strict_types=1);

namespace Models\Entities;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "feedbacks")]
class Feedback
{
    #[DBColumn(isPK: true)]
    public int $id;
    public string $name;
    public string $email;
    public string $message;
    #[DBColumn(name: 'created_at', insert: false, update: false)]
    public string $createdAt;
}