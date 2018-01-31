<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.1.2018
 * Time: 10:57
 */

namespace Zuffik\Srvant\System\Files;


use Zuffik\Srvant\Types\Enum;

/**
 * Class Stream
 * @package Zuffik\Srvant\System\Files
 */
// TODO: Rest
class Stream extends Enum
{
    const READ = 'r';
    const WRITE = 'w';
    const APPEND = 'a';
}