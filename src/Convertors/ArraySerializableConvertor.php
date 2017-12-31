<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 10.12.2016
 * Time: 14:53
 */

namespace Zuffik\Srvant\Convertors;


use Zuffik\Srvant\Data\ArrayList;
use Zuffik\Srvant\Data\BasicStructure;
use Zuffik\Srvant\Data\HashMap;
use Zuffik\Srvant\SerializableChecker;

class ArraySerializableConvertor
{
    use SerializableChecker;
    /**
     * @param BasicStructure $serializable
     * @param array $result
     * @return mixed
     */
    public static function toArray($serializable, $result = [])
    {
        if(self::serializable($serializable)) {
            $serializable = $serializable->toArray();
        }
        if(is_scalar($serializable) || empty($serializable)) {
            return $serializable;
        }
        foreach ($serializable as $key => $value) {
            $result[$key] = self::toArray($value);
        }
        return $result;
    }

    /**
     * @param array $array
     * @return BasicStructure
     */
    public static function toSerializable($array)
    {
        $serializable = array_keys($array) !== range(0, count($array) - 1) ? new HashMap() : new ArrayList();
        foreach ($array as $key => $value) {
            if($serializable instanceof HashMap) {
                $serializable->put($key, is_array($value) ? self::toSerializable($value) : $value);
            } else {
                $serializable->add(is_array($value) ? self::toSerializable($value) : $value);
            }
        }
        return $serializable;
    }
}