<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 16.9.2017
 * Time: 16:55
 */

namespace Zuffik\Srvant\Types\StringActions\Partitioning;


use Zuffik\Srvant\Types\Str;

/**
 * Class UntilFirst splits string from last provided character position to last character position.
 * @package Zuffik\Srvant\Types\StringActions\Partitioning
 */
class FromLast implements PartitionAction
{
    /**
     * @inheritdoc
     */
    public function process(Str $str, $character = '')
    {
        $string = substr(strrchr((string) $str, $character), 1);
        return $str->setValue($string === false ? '' : $string);
    }
}