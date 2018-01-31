<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.1.2018
 * Time: 10:33
 */

namespace Zuffik\Srvant\System;


use Zuffik\Srvant\Types\Str;

/**
 * Class Path
 * @package Zuffik\Srvant\System
 * SYSTEM DEPENDENT (unix)
 */
class Path
{
    /**
     * @var Str
     */
    private $path;

    /**
     * Path constructor.
     * @param Path|Str|string $path
     */
    public function __construct($path = '')
    {
        $this->path = string($path instanceof Path ? $path->path : $this->makeAbsolute($path));
    }

    /**
     * @return Str
     */
    public function getPath()
    {
        return $this->path;
    }

    protected function makeAbsolute($path)
    {
        $isRelativePath = strlen($path) == 0 || $path[0] != '/';
        if (strpos($path, ':') === false && $isRelativePath) {
            $path = getcwd() . DIRECTORY_SEPARATOR . $path;
        }
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
        $parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
        $absolutes = [];
        foreach ($parts as $part) {
            if ('.' == $part) {
                continue;
            }
            if ('..' == $part) {
                array_pop($absolutes);
            } else {
                $absolutes[] = $part;
            }
        }
        $path = implode(DIRECTORY_SEPARATOR, $absolutes);
        if (file_exists($path) && linkinfo($path) > 0) {
            $path = readlink($path);
        }
        $path = '/' . $path;
        return $path;
    }

    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return (string) $this->path;
    }
}