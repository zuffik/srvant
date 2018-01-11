<?php
/**
 * Created by PhpStorm.
 * UserModule: zuffik
 * Date: 7.7.2016
 * Time: 15:33
 */

namespace Zuffik\Srvant\Structures\Lists;


use Exception;
use Zuffik\Srvant\Structures\IArray;
use Zuffik\Srvant\Structures\OrderedStructure;
use Zuffik\Srvant\Structures\Structure;

/**
 * Used as wrapper for array with additional functionality.
 * @package Zuffik\Srvant\Structures\Lists
 */
class ArrayList extends OrderedStructure
{
    /**
     * @var array
     */
    protected $array;

    /**
     * @inheritdoc
     */
    public function __construct($param = null)
    {
        parent::__construct($param);
        if (func_num_args() > 1) {
            $param = func_get_args();
        }
        if (empty($param)) {
            $param = [];
        }
        if (!$param instanceof IArray && !is_array($param)) {
            throw new Exception(
                'Argument #1 of ' . get_class($this) . '::__construct must be an array or instance of IArray. ' .
                (is_object($param) ? 'Instance of ' . get_class($param) : gettype($param)) . ' given'
            );
        }
        $this->array = array_values($param instanceof IArray ? $param->toArray() : $param);
    }

    /**
     * @inheritDoc
     */
    public function map($callable)
    {
        $this->array = array_values(array_map($callable, $this->array, array_keys($this->array)));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function push($value)
    {
        $this->array = array_values(array_merge($this->array, func_get_args()));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function slice($start = 0, $length = null)
    {
        $this->array = array_values(array_slice($this->array, intval($start), $length));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sort($callable)
    {
        usort($this->array, $callable);
        $this->array = array_values($this->array);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function reverse()
    {
        $this->array = array_values(array_reverse($this->array));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function diff($array)
    {
        $this->array = array_values(array_diff($this->array, (array)$array));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->array);
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->array;
    }

    /**
     * @inheritDoc
     */
    public function merge($structure)
    {
        if ($structure instanceof IArray) {
            $structure = $structure->toArray();
        }
        if (!is_array($structure)) {
            throw new Exception(
                'Argument #1 of ' . get_class($this) . '::mergeWith must be an array or instance of IArray. ' .
                (is_object($structure) ? 'Instance of ' . get_class($structure) : gettype($structure)) . ' given'
            );
        }
        $this->array = array_merge($this->array, $structure);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function filter($callable)
    {
        $this->array = array_values(array_filter($this->array, $callable, ARRAY_FILTER_USE_BOTH));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        $this->array = array();
    }

    /**
     * @inheritDoc
     */
    public function get($key)
    {
        $count = $this->count();
        if ($key >= $count) {
            throw new Exception("Index out of bounds (requested: $key, limit: $count)");
        }
        return $this->array[$key];
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value)
    {
        $this->array[intval($key)] = $value;
        $this->array = array_values($this->array);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function remove($key)
    {
        unset($this->array[$key]);
        $this->array = array_values($this->array);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function keyExists($key)
    {
        return array_key_exists($key, $this->array);
    }

    /**
     * @inheritDoc
     */
    public function unify()
    {
        $this->array = array_values(array_map('unserialize', array_unique(array_map('serialize', $this->array))));
        return $this;
    }

    /**
     * Add value to beginning of List
     * @param mixed $value
     * @return OrderedStructure
     */
    public function pushFirst($value)
    {
        $this->array = array_merge([$value], $this->array);
        return $this;
    }

    /**
     * @param mixed $value
     * @param bool $firstOnly
     * @return Structure
     */
    public function removeByValue($value, $firstOnly = true)
    {
        foreach ($this->array as $i => $item) {
            if($item == $value) {
                unset($this->array[$i]);
                if($firstOnly) {
                    break;
                }
            }
        }
        return $this;
    }
}
