<?php

declare(strict_types=1);

namespace Configs;

final readonly class DBConfigs
{
    public function __construct(
        public string $servername,
        public string $username,
        public string $password,
        public string $dbname,
    )
    {
    }

    public static function fromEnv(): self
    {
        return new DBConfigs(
            getenv('DB_SERVER'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'),
            getenv('DB_NAME')
        );
    }
}