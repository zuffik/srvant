<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 16.9.2017
 * Time: 16:55
 */

namespace Zuffik\Srvant\Types\StringActions\Partitioning;


use Zuffik\Srvant\Types\Str;

class UntilLast implements PartitionAction
{

    public function process(Str $str, $character = '')
    {
        return $str->substring(0, intval(strrpos((string) $str, $character)));
    }
}