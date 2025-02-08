<?php

declare(strict_types=1);

namespace Repositories;

use DBDataSource;
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

    /** @return T */
    public function findById(int $id)
    {
        $result = $this->dataSource->query("SELECT * FROM {$this->classMapper->tableName} WHERE id=?", [$id]);
        if (count($result) == 0) return null;
        return $this->classMapper->mapFromDB($result[0]);
    }

    /** @param T[] $entities */
    public function insert(array $entities): null|int|string
    {
        $columns = $this->classMapper->columns;
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
            return "VALUES($vals)";
        }, $entitiesValues));
        $query = "INSERT INTO {$this->classMapper->tableName} ($cols) $values";
        $params = [];
        foreach ($entitiesValues as $item) {
            array_push($params, ...$item);
        }
        return $this->dataSource->execute($query, $params);
    }

    /** @param T $entity */
    public function update($entity, ?array $columns = null): null|int|string
    {
        $columns ??= $this->classMapper->columns;
        unset($columns['id']);
        $values = $this->classMapper->mapToDB($entity);
        $entityValues = [];
        $cols = [];
        foreach ($columns as $prop => $col) {
            $entityValues[] = $values->$col;
            $cols[] = "$col=?";
        }
        $cols = join(",", $cols);
        $query = "UPDATE {$this->classMapper->tableName} SET $cols WHERE id=?";
        $params = array_values($entityValues);
        $params[] = $entity->id;
        return $this->dataSource->execute($query, $params);
    }
}