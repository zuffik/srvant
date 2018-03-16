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
 * Class UntilFirst splits string from first provided character position to last provided character position.
 * @package Zuffik\Srvant\Types\StringActions\Partitioning
 */
class AllBetween implements PartitionAction
{
    /**
     * @param Str $str
     * @param string $character
     * @return Str
     * @throws ErrorException
     */
    public function process(Str $str, $character = '')
    {
        return (new UntilLast())->process((new FromFirst())->process($str, $character), $character);
    }
}