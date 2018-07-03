<?php

namespace Zuffik;

use Zuffik\Srvant\Exceptions\ErrorException;
use Zuffik\Srvant\Exceptions\InvalidArgumentException;
use Zuffik\Srvant\Formats\CSV;
use Zuffik\Srvant\Formats\JSON;
use Zuffik\Srvant\Formats\Regex;
use Zuffik\Srvant\Formats\URL;
use Zuffik\Srvant\Generators\Random\Distributions;
use Zuffik\Srvant\Generators\Random\Distributions\Distribution;
use Zuffik\Srvant\Generators\Random\Random;
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
     * @throws InvalidArgumentException
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
     * @throws ErrorException
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
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
     * @throws InvalidArgumentException
     */
    function hashMap($param = [])
    {
        return new HashMap($param);
    }
}

if(!function_exists('number')) {
    /**
     * @param int $value
     * @return \Zuffik\Srvant\Types\Number
     * @throws InvalidArgumentException
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
     * @return \Zuffik\Srvant\Types\Integer
     * @throws InvalidArgumentException
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
     * @return \Zuffik\Srvant\Types\Double
     * @throws InvalidArgumentException
     */
    function double($value = 0.0, $strict = true)
    {
        return new Double($value, $strict);
    }
}

if(!function_exists('boolean')) {
    /**
     * @param boolean|Boolean $value
     * @return \Zuffik\Srvant\Types\Boolean
     */
    function boolean($value)
    {
        return new Boolean($value);
    }
}

if(!function_exists('random')) {
    /**
     * @param string $distribution
     * @param array $args
     * @return Random|Distribution
     */
    function random($distribution = Random::class, ...$args)
    {
        try {
            $distribution = Distributions::verify($distribution);
            $refClass = new \ReflectionClass($distribution);
            $constructor = $refClass->getConstructor();
            $numArgs = count($args);
            if(!empty($constructor)) {
                $numRequiredArgs = $constructor->getNumberOfRequiredParameters();
                $numAllArgs = $constructor->getNumberOfParameters();
                if($numArgs < $numRequiredArgs && $numArgs > $numAllArgs) {
                    throw new InvalidArgumentException("Invalid number of arguments $numArgs (must be between $numRequiredArgs and $numAllArgs)");
                }
            }
            return $refClass->newInstanceArgs($args);
        } catch (\Exception $e) {
            return new Random();
        }
    }
}

if(!function_exists('url')) {
    /**
     * @param string $path
     * @return URL
     * @throws InvalidArgumentException
     */
    function url($path = '')
    {
        return new Url($path);
    }
}

if(!function_exists('csv')) {
    /**
     * @param resource|ArrayList $data
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     * @param bool $hasHead
     * @return CSV
     * @throws InvalidArgumentException
     * @throws ErrorException
     */
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
