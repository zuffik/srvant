<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 4.10.2017
 * Time: 12:21
 */

namespace Zuffik\Srvant\Helpers;


use ArrayAccess;
use Zuffik\Srvant\Exceptions\InvalidArgumentException;

class RecursiveGetter
{
    /**
     * Elementary action used in Finder.
     * It either calls method on item or use $methodKey (or its elements) as array index and returns it.
     * @param object|array $item
     * @param string|string[] $methodKey
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function get($item, $methodKey)
    {
        if (!is_array($methodKey)) {
            $methodKey = [$methodKey];
        }
        $val = $item;
        foreach ($methodKey as $m) {
            if (is_array($val) && !array_key_exists($m, $val)) {
                throw new InvalidArgumentException("Not existing key: $m");
            }
            if (is_object($val) && !method_exists($val, $m) && !$val instanceof ArrayAccess) {
                throw new InvalidArgumentException('Object of class ' . get_class($val) . ' has no method ' . $m);
            }
            $val = is_array($val) || $val instanceof ArrayAccess ? $val[$m] : call_user_func([$val, $m]);
        }
        return $val;
    }
}