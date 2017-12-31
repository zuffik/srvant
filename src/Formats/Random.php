<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 10.9.2017
 * Time: 20:15
 */

namespace Zuffik\Srvant\Formats;

use Zuffik\Srvant\Types\Double;
use Zuffik\Srvant\Types\Integer;
use Zuffik\Srvant\Types\Str;

/**
 * Class Random
 * @package Zuffik\Srvant\Formats
 * @deprecated use Zuffik\Srvant\Generators\Random\ distributions or Random class
 */
class Random
{
    /**
     * @param int $min
     * @param int $max
     * @return integer
     */
    public function integer($min, $max)
    {
        return rand(min($min, $max), max($min, $max));
    }

    /**
     * @param float|int $min
     * @param float|int $max
     * @param int $range
     * @return float
     */
    public function decimal($min, $max, $range = 100)
    {
        return $this->integer($min * $range, $max * $range) / $range;
    }

    /**
     * @param int $length
     * @param string|Str $characters
     * @return \Zuffik\Srvant\Types\Str
     */
    public function string($length = 10, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $charactersLength = string($characters)->length();
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[(string) $this->integer(0, $charactersLength - 1)];
        }
        return string($string);
    }
}