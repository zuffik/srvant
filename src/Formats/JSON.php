<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 10.12.2016
 * Time: 23:05
 */

namespace Zuffik\Srvant\Formats;


use ArrayAccess;
use Iterator;
use Zuffik\Srvant\Convertors\ArrayStructureConverter;
use Zuffik\Srvant\Exceptions\ErrorException;
use Zuffik\Srvant\Exceptions\InvalidArgumentException;
use Zuffik\Srvant\Structures\IArray;
use Zuffik\Srvant\Structures\Structure;
use Zuffik\Srvant\System\Files\File;
use Zuffik\Srvant\System\Path;

/**
 * Class JSON. Class for working with JSON format.
 * @package Zuffik\Srvant\Formats
 */
class JSON implements ArrayAccess, Iterator, IArray
{
    /** @var Structure */
    private $array;

    /**
     * JSON constructor. Param can be any of json-compatible types (array types, string or JSON class itself).
     * Also checks for it validity.
     * @param array|Structure|string|JSON $json
     * @throws InvalidArgumentException
     * @throws ErrorException
     */
    public function __construct($json)
    {
        if (is_resource($json)) {
            $json = stream_get_contents($json);
        } else if ($json instanceof File) {
            $json = $json->read();
        } else if ($json instanceof Path) {
            $json = file_get_contents((string)$json);
        }
        if (is_string($json)) {
            $decoded = json_decode($json, true);
            if ($decoded === null) {
                $error = json_last_error_msg();
                throw new InvalidArgumentException("Empty or corrupted JSON string: $error ($json)");
            }
            $this->array = ArrayStructureConverter::toStructure($decoded);
        } else if ($json instanceof Structure) {
            $this->array = $json;
        } else if ($json instanceof JSON) {
            $this->array = $json->array;
        } else if (!empty($json)) {
            $this->array = ArrayStructureConverter::toStructure($json);
        } else {
            $this->array = [];
        }
    }

    /**
     * @return Structure
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->array->toArray();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return json_encode(ArrayStructureConverter::toArray($this->array));
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->array);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->array[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->array[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->array);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->array);
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->array);
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
        return $this->offsetExists(key($this->array));
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->array);
    }
}