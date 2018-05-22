<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 3.1.2017
 * Time: 11:42
 */

namespace Zuffik\Srvant\Formats;


use Exception;
use Zuffik\Srvant\Structures\Lists\ArrayList;
use Zuffik\Srvant\Structures\Maps\HashMap;
use Zuffik\Srvant\Structures\OrderedStructure;

class ExceptionFormatter
{
    /**
     * Formats a exception to readable format.
     * @param Exception $exception
     * @return $this|OrderedStructure
     * @throws \Zuffik\Srvant\Exceptions\InvalidArgumentException
     */
    public static function format(Exception $exception)
    {
        return (new ArrayList($exception->getTrace()))->map(function ($traceItem) {
            $traceItem = new HashMap($traceItem);
            $result = '';
            if (!empty($traceItem['file'])) {
                $result .= $traceItem['file'] . ':' . $traceItem['line'] . ' ';
            }
            if (!empty($traceItem['class'])) {
                $result .= $traceItem['class'] . $traceItem['type'];
            }
            $result .= $traceItem['function'] . '(' . (new ArrayList($traceItem->get('args', [])))->map(function ($item) {
                    return is_object($item) ? get_class($item) : $item;
                })->join(', ') . ')';
            return $result;
        });
    }

    public static function asString(Exception $exception)
    {
        $class = get_class($exception);
        return "$class: {$exception->getMessage()} \n{$exception->getTraceAsString()}";
    }
}