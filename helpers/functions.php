<?php

use Zuffik\Srvant\Generators\Random\Random;
use Zuffik\Srvant\Formats\CSV;
use Zuffik\Srvant\Formats\JSON;
use Zuffik\Srvant\Formats\Regex;
use Zuffik\Srvant\Formats\URL;
use Zuffik\Srvant\Structures\Lists\ArrayList;
use Zuffik\Srvant\Structures\Lists\LinkedList;
use Zuffik\Srvant\Structures\Maps\HashMap;
use Zuffik\Srvant\Structures\Structure;
use Zuffik\Srvant\System\Path;
use Zuffik\Srvant\Types\Boolean;
use Zuffik\Srvant\Types\Double;
use Zuffik\Srvant\Types\Integer;
use Zuffik\Srvant\Types\Number;
use Zuffik\Srvant\Types\Str;

if(!function_exists('string')) {
    /**
     * @param string|Str $str
     * @return Str
     */
    function string($str)
    {
        return new Str((string) $str);
    }
}

if(!function_exists('regex')) {
    /**
     * @param string|Regex $regex
     * @return Regex
     */
    function regex($regex)
    {
        return new Regex((string) $regex);
    }
}

if(!function_exists('json')) {
    /**
     * @param array|Structure|string|JSON $json
     * @return JSON
     */
    function json($json)
    {
        return new JSON($json);
    }
}

if(!function_exists('arrayList')) {
    /**
     * @param array|Structure $param
     * @return ArrayList
     */
    function arrayList($param = [])
    {
        return new ArrayList($param);
    }
}

if(!function_exists('linkedList')) {
    /**
     * @param array|Structure $param
     * @return LinkedList
     */
    function linkedList($param = [])
    {
        return new LinkedList($param);
    }
}

if(!function_exists('hashMap')) {
    /**
     * @param array|Structure $param
     * @return HashMap
     */
    function hashMap($param = [])
    {
        return new HashMap($param);
    }
}

if(!function_exists('number')) {
    /**
     * @param int $value
     * @return Number
     */
    function number($value = 0)
    {
        return Number::create($value);
    }
}

if(!function_exists('integer')) {
    /**
     * @param int $value
     * @param bool $strict default true. If you want not to type false everywhere use function number
     * @return Integer
     */
    function integer($value = 0, $strict = true)
    {
        return new Integer($value, $strict);
    }
}

if(!function_exists('double')) {
    /**
     * @param float $value
     * @param bool $strict default true. If you want not to type false everywhere use function number
     * @return Double
     */
    function double($value = 0.0, $strict = true)
    {
        return new Double($value, $strict);
    }
}

if(!function_exists('boolean')) {
    /**
     * @param boolean|Boolean $value
     * @return Boolean
     */
    function boolean($value)
    {
        return new Boolean($value);
    }
}

if(!function_exists('random')) {
    function random()
    {
        return new Random();
    }
}

if(!function_exists('url')) {
    function url($path = '')
    {
        return new Url($path);
    }
}

if(!function_exists('csv')) {
    function csv($data, $delimiter = ';', $enclosure = '"', $escape = '\\', $hasHead = true)
    {
        return new CSV($data, $delimiter, $enclosure, $escape, $hasHead);
    }
}

if(!function_exists('path')) {
    /**
     * @param Str|string|Path $path
     * @return Path
     */
    function path($path)
    {
        return new Path($path);
    }
}
