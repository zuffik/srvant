<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 16.9.2017
 * Time: 16:49
 */

namespace Zuffik\Srvant\Types\StringActions;


use Zuffik\Srvant\Types\Str;

/**
 * Action provides interface for string actions.
 * @package Zuffik\Srvant\Types\StringActions
 */
interface Action
{
    /**
     * Returns processed string.
     * @param Str $str
     * @return Str
     */
    public function process(Str $str);
}