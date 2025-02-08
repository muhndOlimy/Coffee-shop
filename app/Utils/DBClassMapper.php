<?php

declare(strict_types=1);

namespace Utils;

use Configs\DBColumn;
use Configs\DBTable;
use ReflectionClass;
use stdClass;

/** @template T */
class DBClassMapper
{
    public string $tableName;
    public array $columns;

    /** @param class-string<T> $class */
    public function __construct(private readonly string $class)
    {
        $this->tableName = $this::findTableName($this->class);
        $this->columns = $this::findColumnNames($this->class);
    }

    /** @param T $entity */
    public function mapToDB($entity): stdClass
    {
        $row = new stdClass();
        foreach (get_class_vars($entity::class) as $prop => $_) {
            $col = $this::findColumnName($this->class, $prop);
            $row->$col = $entity->$prop ?? null;
        }
        return $row;
    }

    /** @return T */
    public function mapFromDB(stdClass $row)
    {
        $instance = new $this->class();
        foreach (get_class_vars($this->class) as $prop => $_) {
            $col = $this::findColumnName($this->class, $prop);
            if (property_exists($row, $col)) {
                $instance->$prop = $row->$col;
            } else {
                $instance->$prop = null;
            }
        }
        return $instance;
    }

    private static function findColumnName(string $class, string $prop): string
    {
        $reflection = new ReflectionClass($class);
        $propRef = $reflection->getProperty($prop);
        $columnAttr = $propRef->getAttributes(DBColumn::class);
        if (count($columnAttr) == 0 || !isset($columnAttr[0]->getArguments()['name'])) {
            return $propRef->getName();
        }
        return $columnAttr[0]->getArguments()['name'];
    }

    private static function findTableName(string $class): string
    {
        $reflection = new ReflectionClass($class);
        $tableAttr = $reflection->getAttributes(DBTable::class);
        if (count($tableAttr) == 0 || !isset($tableAttr[0]->getArguments()['name'])) {
            return $reflection->getShortName();
        }
        return $tableAttr[0]->getArguments()['name'];
    }

    private static function findColumnNames(string $class): array
    {
        $columns = [];
        foreach (get_class_vars($class) as $prop => $_) {
            $columns[$prop] = self::findColumnName($class, $prop);
        }
        return $columns;
    }

    private function mapRow(stdClass $row)
    {
        $instance = new $this->class();
        foreach (get_object_vars($instance) as $prop => $val) {
            $col = $this::findColumnName($this->class, $prop);
            if (property_exists($row, $col)) {
                $instance->$prop = $row->$col;
            }
        }
        return $instance;
    }
}