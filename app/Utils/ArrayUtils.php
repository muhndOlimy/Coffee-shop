<?php

namespace Utils;

class ArrayUtils
{
    /**
     * @template T
     * @template R
     * @param T[] $array
     * @param callable(T):R $callback
     * @return array<R, T>
     */
    public static function groupBy(array $array, callable $callback): array
    {
        $return = array();
        foreach ($array as $val) {
            $return[call_user_func($callback, $val)][] = $val;
        }
        return $return;
    }
}