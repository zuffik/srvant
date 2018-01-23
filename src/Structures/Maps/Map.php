<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 23.1.2018
 * Time: 21:53
 */

namespace Zuffik\Srvant\Structures\Maps;


use Zuffik\Srvant\Structures\Lists\ArrayList;

interface Map
{
    /**
     * Returns all keys used in map in ArrayList
     * @return ArrayList
     */
    public function getKeys();
}