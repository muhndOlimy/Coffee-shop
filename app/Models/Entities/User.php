<?php

declare(strict_types=1);

namespace Models\Entities;

use Configs\DBColumn;
use Configs\DBTable;

#[DBTable(name: "users")]
class User
{
    #[DBColumn(isPK: true)]
    public int $id;
    public string $username;
    public string $password;
    #[DBColumn(name: 'first_name')]
    public string $firstName;
    #[DBColumn(name: 'last_name')]
    public string $lastName;
    public string $email;
    #[DBColumn(name: 'created_at', insert: false, update: false)]
    public string $createdAt;
    #[DBColumn(name: 'state_id')]
    public int $stateId;
    public string $gender;
}