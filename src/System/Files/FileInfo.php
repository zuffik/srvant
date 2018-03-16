<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.1.2018
 * Time: 10:33
 */

namespace Zuffik\Srvant\System\Files;


use Zuffik\Srvant\System\Path;
use Zuffik\Srvant\Types\Str;

abstract class FileInfo
{
    /**
     * @var Path
     */
    protected $path;

    /**
     * FileInfo constructor.
     * @param Path|Str|string $path
     */
    public function __construct($path)
    {
        $this->path = new Path($path);
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return file_exists((string)$this->path);
    }

    /**
     * @return Path
     */
    public function getPath()
    {
        return $this->path;
    }
}