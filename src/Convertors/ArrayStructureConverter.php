<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 10.12.2016
 * Time: 14:53
 */

namespace Zuffik\Srvant\Convertors;


use Zuffik\Srvant\Structures\Lists\ArrayList;
use Zuffik\Srvant\Structures\Maps\HashMap;
use Zuffik\Srvant\Structures\Structure;

/**
 * Used for convert array to Structure and vice-versa
 * Class ArraySerializableConvertor
 * @package Zuffik\Srvant\Convertors
 */
class ArrayStructureConverter
{

    /**
     * Converts Structure to array
     * @param Structure $structure
     * @param array $result
     * @return mixed
     */
    public static function toArray($structure, $result = [])
    {
        if($structure instanceof Structure) {
            $structure = $structure->toArray();
        }
        if(is_scalar($structure) || empty($structure)) {
            return $structure;
        }
        foreach ($structure as $key => $value) {
            $result[$key] = self::toArray($value);
        }
        return $result;
    }

    /**
     * Converts array to structure. Also checks for continuous indexes to determine if it is Map or List
     * @param array $array
     * @return Structure
     */
    public static function toStructure($array)
    {
        if(!$array) {
            return null;
        }
        $serializable = array_keys($array) !== range(0, count($array) - 1) ? new HashMap() : new ArrayList();
        foreach ($array as $key => $value) {
            if($serializable instanceof HashMap) {
                $serializable->set($key, is_array($value) ? self::toStructure($value) : $value);
            } else {
                $serializable->push(is_array($value) ? self::toStructure($value) : $value);
            }
        }
        return $serializable;
    }
}