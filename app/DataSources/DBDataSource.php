<?php

declare(strict_types=1);

use Configs\DBConfigs;

class DBDataSource
{
    private mysqli $conn;

    public function __construct(private readonly DBConfigs $dbConfigs)
    {
    }

    public function connect(): void
    {
        $this->conn = new mysqli(
            $this->dbConfigs->servername,
            $this->dbConfigs->username,
            $this->dbConfigs->password,
            $this->dbConfigs->dbname
        );
        if ($this->conn->connect_error) {
            throw new Exception($this->conn->connect_error);
        }
    }

    public function execute(string $query, array $params = []): null|int|string
    {
        $this->assertConnectionExists();
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($this->paramsTypes($params), ...$params);
        try {
            if (!$stmt->execute()) {
                throw new Exception($stmt->error);
            }
        } catch (mysqli_sql_exception $e) {
            throw new Exception($e->getMessage());
        }
        $result = $stmt->get_result();
        return $stmt->insert_id ?? null;
    }

    public function query(string $query, array $params = []): array
    {
        $this->assertConnectionExists();
        $stmt = $this->conn->prepare($query);
        if (count($params)) {
            $stmt->bind_param($this->paramsTypes($params), ...$params);
        }
        try {
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            throw new Exception($e->getMessage());
        }
        $result = $stmt->get_result();
        $data = [];
        if (!$result || $result->num_rows == 0) return $data;
        while ($row = $result->fetch_assoc()) {
            $data[] = (object)$row;
        }
        return $data;
    }

    private function assertConnectionExists()
    {
        if (!isset($this->conn) || $this->conn->connect_error) {
            throw new Exception("No connection");
        }
    }

    public function __destruct()
    {
        if (isset($this->conn)) {
            $this->conn->close();
        }
    }

    private function paramsTypes(array $params): string
    {
        return join(array_map(function ($param): string {
            return match (gettype($param)) {
                'integer', 'boolean' => 'i',
                'double' => 'd',
                'string' => 's',
                default => 'b',
            };
        }, $params));
    }
}
