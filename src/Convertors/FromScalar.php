<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 10.1.2017
 * Time: 14:45
 */

namespace Zuffik\Srvant\Convertors;


class FromScalar
{
    /**
     * Make object from scalar type (eg. serialized string) or returns given parameter.
     * @param $input
     * @return mixed
     */
    public static function formatInput($input)
    {
        $unserialized = @unserialize($input);
        if($unserialized !== false) {
            $input = $unserialized;
        }
        return $input;
    }
}