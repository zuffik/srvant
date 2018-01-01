<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 16.9.2017
 * Time: 17:22
 */

namespace Zuffik\Srvant\Types\StringActions\Partitioning;


use Zuffik\Srvant\Types\Enum;

/**
 * Enumerator for string actions
 * @package Zuffik\Srvant\Types\StringActions\Partitioning
 */
class StringPartition extends Enum
{
    const STR_PART_UNTIL_FIRST = UntilFirst::class;
    const STR_PART_FROM_LAST = FromLast::class;
    const STR_PART_ALL_BETWEEN = AllBetween::class;
    const STR_PART_UNTIL_LAST = UntilLast::class;
    const STR_PART_FROM_FIRST = FromFirst::class;
}