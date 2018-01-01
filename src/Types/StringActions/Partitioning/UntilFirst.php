<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 16.9.2017
 * Time: 16:51
 */

namespace Zuffik\Srvant\Types\StringActions\Partitioning;


use Zuffik\Srvant\Types\Str;

/**
 * Class UntilFirst splits string from first character position to first provided character position.
 * @package Zuffik\Srvant\Types\StringActions\Partitioning
 */
class UntilFirst implements PartitionAction
{
    /**
     * @inheritdoc
     */
    public function process(Str $str, $character = '')
    {
        $pos = intval($str->find($character));
        return $str->substring(0, $pos < 0 ? 0 : $pos);
    }
}