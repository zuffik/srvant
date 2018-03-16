<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 16.9.2017
 * Time: 16:55
 */

namespace Zuffik\Srvant\Types\StringActions\Partitioning;


use Zuffik\Srvant\Exceptions\ErrorException;
use Zuffik\Srvant\Types\Str;

/**
 * Class UntilFirst splits string from first character position to last provided character position.
 * @package Zuffik\Srvant\Types\StringActions\Partitioning
 */
class UntilLast implements PartitionAction
{
    /**
     * @param Str $str
     * @param string $character
     * @return Str
     * @throws ErrorException
     */
    public function process(Str $str, $character = '')
    {
        return $str->substring(0, intval(strrpos((string)$str, $character)));
    }
}