<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.10.2017
 * Time: 0:15
 */

namespace Zuffik\Srvant\Formats;


use Zuffik\Srvant\Convertors\ArrayStructureConverter;
use Zuffik\Srvant\Structures\IArray;
use Zuffik\Srvant\Structures\Lists\ArrayList;
use Zuffik\Srvant\System\Files\File;
use Zuffik\Srvant\System\Files\Stream;
use Zuffik\Srvant\System\Path;

/**
 * Class CSV. Usage:
 * ```php
 * $csv = new CSV('path/to/csv.csv', ',', "'");
 * foreach($csv as $line) {
 *  print_r($line);
 *  // prints ArrayList containing a line
 * }
 * ```
 * @package Zuffik\Srvant\Formats
 */
class CSV implements \Iterator, IArray
{
    /**
     * @var ArrayList|resource
     */
    private $data;
    /**
     * @var string
     */
    private $delimiter;
    /**
     * @var string
     */
    private $enclosure;
    /**
     * @var string
     */
    private $escape;
    /**
     * @var int
     */
    private $line;
    /**
     * @var array|boolean
     */
    private $current = '';

    /**
     * CSV constructor.
     * @param ArrayList|resource $data
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     * @param bool $hasHead
     * @throws \Exception
     */
    public function __construct($data, $delimiter = ';', $enclosure = '"', $escape = '\\', $hasHead = true)
    {
        if($data instanceof File) {
            $data->open(Stream::READ);
            $data = $data->getResource();
        } else if($data instanceof Path) {
            $data = file_get_contents((string)$data);
        }
        if(is_array($data)) {
            $data = ArrayStructureConverter::toStructure($data);
            if(!empty($data->toArray()) > 0 && !$data[0] instanceof ArrayList) {
                $data = \arrayList([$data]);
            }
        } else if(is_object($data) && $data instanceof CSV) {
            $data = $data->data;
        } else if(is_string($data) || (is_object($data) && method_exists($data, '__toString'))) {
            $data = string($data)->split(PHP_EOL)->map(function($item) use($delimiter, $enclosure, $escape) {
                return str_getcsv((string) $item, $delimiter, $enclosure, $escape);
            });
        } else if(!is_resource($data)) {
            throw new \Exception('Unknown CSV format.');
        }
        $this->data = $data;
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
        $this->line = intval($hasHead);
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        if($this->data instanceof ArrayList) {
            return $this->data->current();
        } else {
            return \arrayList($this->current);
        }
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        if($this->data instanceof ArrayList) {
            $this->data->next();
        } else {
            $this->line++;
        }
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        if($this->data instanceof ArrayList) {
            return $this->data->key();
        } else {
            return $this->line;
        }
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        if($this->data instanceof ArrayList) {
            return $this->data->valid();
        } else {
            $this->current = fgetcsv($this->data, 0, $this->delimiter, $this->enclosure, $this->escape);
            return $this->current !== false && $this->current !== null;
        }
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        if($this->data instanceof ArrayList) {
            $this->data->rewind();
        } else {
            rewind($this->data);
        }
    }

    /**
     * Every object can be converted to array due to high native PHP compatibility.
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this as $item) {
            $result[] = $item;
        }
        return $result;
    }
}