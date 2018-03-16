<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 16.9.2017
 * Time: 16:56
 */

namespace Zuffik\Srvant\Types\StringActions\Partitioning;


use Zuffik\Srvant\Types\Str;

/**
 * Class UntilFirst splits string from first provided character position to last character position.
 * @package Zuffik\Srvant\Types\StringActions\Partitioning
 */
class FromFirst implements PartitionAction
{
    /**
     * @param Str $str
     * @param string $character
     * @return Str
     */
    public function process(Str $str, $character = '')
    {
        $string = substr(strchr((string)$str, $character), 1);
        return $str->setValue($string === false ? '' : $string);
    }
}