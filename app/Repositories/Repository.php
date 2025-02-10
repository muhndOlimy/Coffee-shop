<?php

declare(strict_types=1);

namespace Repositories;

use DBDataSource;
use stdClass;
use Utils\DBClassMapper;

/** @template T */
class Repository
{
    private DBClassMapper $classMapper;

    /** @param class-string<T> $class */
    public function __construct(private readonly DBDataSource $dataSource,
                                private readonly string       $class)
    {
        $this->classMapper = new DBClassMapper($this->class);
    }

    /**
     * @param array<string, mixed>|mixed $id
     * @return T
     */
    public function findById(mixed $id)
    {
        $whereVals = $this->preparePKs($id);
        $where = $this->generateWhereClause();
        $result = $this->dataSource->query("SELECT * FROM {$this->classMapper->tableName} WHERE $where", [...$whereVals]);
        if (count($result) == 0) return null;
        return $this->classMapper->mapFromDB($result[0]);
    }

    /**
     * @param array<string, mixed> $cols
     * @return T
     */
    public function findBy(array $cols = [])
    {
        $result = $this->findAllByImpl($cols);
        if (count($result) == 0) return null;
        return $this->classMapper->mapFromDB($result[0]);
    }

    /**
     * @param array<string, mixed> $cols
     * @return T[]
     */
    public function findAllBy(array $cols = []): array
    {
        $result = $this->findAllByImpl($cols);
        return array_map(fn($row) => $this->classMapper->mapFromDB($row), $result);
    }

    /**
     * @param array<string, mixed> $cols
     * @return stdClass[]
     */
    private function findAllByImpl(array $cols): array
    {
        if (count($cols) == 0) {
            $where = '';
        } else {
            $where = $this->generateWhereClause($cols);
            $where = "WHERE $where";
        }
        return $this->dataSource->query("SELECT * FROM {$this->classMapper->tableName} $where", array_values($cols));
    }

    /** @param T[] $entities */
    public function insert(array $entities): null|int|string
    {
        if (count($entities) == 0) return null;

        $columns = $this->classMapper->insertableColumns;
        $entitiesValues = [];
        foreach ($entities as $entity) {
            $values = $this->classMapper->mapToDB($entity);
            $entityValues = [];
            foreach ($columns as $prop => $col) {
                $entityValues[] = $values->$col;
            }
            $entitiesValues[] = $entityValues;
        }
        $cols = join(",", array_values($columns));
        $vals = join(',', array_fill(0, count($columns), '?'));
        $values = join(",", array_map(function () use ($vals) {
            return "($vals)";
        }, $entitiesValues));
        $query = "INSERT INTO {$this->classMapper->tableName} ($cols) VALUES $values";
        $params = [];
        $params = array_merge($params, ...$entitiesValues);
        return $this->dataSource->execute($query, $params);
    }

    /** @param T $entity */
    public function update($entity, ?array $columns = null): null|int|string
    {
        $columns ??= $this->classMapper->updatableColumns;
        foreach ($this->classMapper->pks as $col) {
            unset($columns[$col]);
            $idKey = array_search($col, $columns, strict: true);
            if ($idKey !== false) {
                unset($columns[$idKey]);
            }
        }

        $values = $this->classMapper->mapToDB($entity);
        $entityValues = [];
        $cols = [];
        foreach ($columns as $col) {
            $entityValues[] = $values->$col;
            $cols[] = "$col=?";
        }
        $cols = join(",", $cols);

        $whereVals = $this->preparePKs($values);
        $where = $this->generateWhereClause();

        $query = "UPDATE {$this->classMapper->tableName} SET $cols WHERE $where";
        $params = array_merge(array_values($entityValues), $whereVals);

        return $this->dataSource->execute($query, $params);
    }

    private function generateWhereClause(?array $pks = null): string
    {
        $pks = is_null($pks) ? array_values($this->classMapper->pks) : array_keys($pks);
        return join(' AND ', array_map(fn($col) => "$col=?", $pks));
    }

    private function preparePKs(mixed $values): array
    {
        if ($values instanceof stdClass) {
            $values = get_object_vars($values);
        }
        if (gettype($values) === 'array') {
            return array_map(function ($col) use ($values) {
                return $values[$col];
            }, array_keys($this->classMapper->pks));
        }
        return [$values];
    }
}