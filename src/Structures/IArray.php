<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 1.1.2018
 * Time: 19:47
 */

namespace Zuffik\Srvant\Structures;


interface IArray
{
    /**
     * Every object can be converted to array due to high native PHP compatibility.
     * @return array
     */
    public function toArray();
}