<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.1.2018
 * Time: 10:55
 */

namespace Zuffik\Srvant\System\Files;


use Zuffik\Srvant\Types\Str;

class File extends FileInfo
{
    /**
     * @var resource|null
     */
    protected $resource = null;

    /**
     * @throws \Exception
     */
    protected function verifyAction()
    {
        if (!$this->exists()) {
            throw new \Exception("File {$this->path} does not exists.");
        }
    }

    /**
     * @param string|Str $stream
     * @throws \Exception
     */
    public function open($stream)
    {
        $this->verifyAction();
        Stream::verify($stream);
        $this->resource = fopen((string)$this->path, $stream);
    }

    /**
     * @return null|resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return bool
     */
    public function isOpen()
    {
        return !empty($this->resource);
    }

    public function close()
    {
        if ($this->isOpen()) {
            fclose($this->resource);
            $this->resource = null;
        }
    }

    /**
     * @param resource $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return bool|string
     * @throws \Exception
     */
    public function read()
    {
        $result = file_get_contents((string)$this->path);
        if($result === false) {
            throw new \Exception("Failed to read {$this->path} file.");
        }
        return $result;
    }

    /**
     * @param string $data
     * @throws \Exception
     */
    public function write($data)
    {
        $result = file_put_contents((string)$this->path, $data);
        if($result === false) {
            throw new \Exception("Failed to write to {$this->path} file.");
        }
    }

    /**
     * @param string $data
     * @throws \Exception
     */
    public function append($data)
    {
        $result = file_put_contents((string)$this->path, file_get_contents((string)$this->path) . $data);
        if($result === false) {
            throw new \Exception("Failed to append to {$this->path} file.");
        }
    }
}