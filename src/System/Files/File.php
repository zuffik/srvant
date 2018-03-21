<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.1.2018
 * Time: 10:55
 */

namespace Zuffik\Srvant\System\Files;


use Zuffik\Srvant\Exceptions\ErrorException;
use Zuffik\Srvant\Exceptions\InvalidArgumentException;
use Zuffik\Srvant\Types\Str;

class File extends FileInfo
{
    /**
     * File handle
     * @var resource|null
     */
    protected $resource = null;

    /**
     * Checks whether file exists
     * @throws InvalidArgumentException
     */
    protected function verifyAction()
    {
        if (!$this->exists()) {
            throw new InvalidArgumentException("File {$this->path} does not exists.");
        }
    }

    /**
     * Opens file handle
     * @param string|Str $stream
     * @throws InvalidArgumentException
     * @throws ErrorException
     */
    public function open($stream)
    {
        $this->verifyAction();
        Stream::verify($stream);
        $this->resource = fopen((string)$this->path, $stream);
    }

    /**
     * @return null|resource file handle
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return bool whether file handle is open
     */
    public function isOpen()
    {
        return !empty($this->resource);
    }

    /**
     * Closes file handle
     */
    public function close()
    {
        if ($this->isOpen()) {
            fclose($this->resource);
            $this->resource = null;
        }
    }

    /**
     * Replaces file handle if exists
     * @param resource $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Reads from file (file may not be open)
     * @return bool|string
     * @throws ErrorException
     */
    public function read()
    {
        $result = file_get_contents((string)$this->path);
        if ($result === false) {
            throw new ErrorException("Failed to read {$this->path} file." . error_get_last()['message']);
        }
        return $result;
    }

    /**
     * Writes to file (file may not be open)
     * @param string $data
     * @throws ErrorException
     */
    public function write($data)
    {
        $result = file_put_contents((string)$this->path, $data);
        if ($result === false) {
            throw new ErrorException("Failed to write to {$this->path} file." . error_get_last()['message']);
        }
    }

    /**
     * Appends to file (may not be open)
     * @param string $data
     * @throws ErrorException
     */
    public function append($data)
    {
        $result = file_put_contents((string)$this->path, file_get_contents((string)$this->path) . $data);
        if ($result === false) {
            throw new ErrorException("Failed to append to {$this->path} file." . error_get_last()['message']);
        }
    }

    /**
     * @return Str mime content type, if none found, returns 'application/octet-stream'
     */
    public function mime()
    {
        $result = string('application/octet-stream');
        if(function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $result->setValue(finfo_file($finfo, (string)$this->path->getPath()));
            finfo_close($finfo);
        } else if(function_exists('mime_content_type')) {
            $result->setValue(mime_content_type((string)$this->path->getPath()));
        }
        return $result;
    }
}