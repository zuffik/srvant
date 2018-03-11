<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 19.10.2017
 * Time: 12:49
 */

namespace Zuffik\Srvant\Helpers;


class Finder
{
    /**
     * Recursively find item with given criteria.
     * @param \Iterator|array $iterable
     * @param mixed $search
     * @param string|string[] $method
     * @param bool $strict whether use == or ===
     * @param bool $stopOnFirst
     * @param bool $index
     * @return mixed
     * @throws \Exception
     */
    public static function find($iterable, $search, $method = null, $strict = false, $stopOnFirst = true, $index = false) {
        $result = $stopOnFirst ? null : [];
        if (!empty($method)) {
            foreach ($iterable as $i => $item) {
                $val = RecursiveGetter::get($item, $method);
                if ($strict) {
                    if ($val === $search) {
                        if($stopOnFirst) {
                            return $index ? $i : $item;
                        } else {
                            $result[] = $index ? $i : $item;
                        }
                    }
                } else {
                    if ($val == $search) {
                        if($stopOnFirst) {
                            return $index ? $i : $item;
                        } else {
                            $result[] = $index ? $i : $item;
                        }
                    }
                }
            }
        } else {
            foreach ($iterable as $i => $item) {
                if ($strict) {
                    if ($item === $search) {
                        if($stopOnFirst) {
                            return $index ? $i : $item;
                        } else {
                            $result[] = $index ? $i : $item;
                        }
                    }
                } else {
                    if ($item == $search) {
                        if($stopOnFirst) {
                            return $i;
                        } else {
                            $result[] = $i;
                        }
                    }
                }
            }
        }
        return $result;
    }
}