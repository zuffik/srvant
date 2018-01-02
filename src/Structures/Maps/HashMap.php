<?php
/**
 * Created by PhpStorm.
 * UserModule: zuffik
 * Date: 7.7.2016
 * Time: 15:33
 */

namespace Zuffik\Srvant\Structures\Maps;


use Zuffik\Srvant\Structures\Lists\ArrayList;
use Zuffik\Srvant\Structures\AbstractStructure;
use Zuffik\Srvant\Structures\Structure;

class HashMap extends AbstractStructure
{
    /**
     * @var array
     */
    protected $array;
    /**
     * @var ArrayList|KeyValue[]
     */
    protected $iterator;

    /**
     * @inheritdoc
     */
    public function __construct($param = null)
    {
        parent::__construct($param);
        if(empty($param)) {
            $param = [];
        }
        if (!$param instanceof Structure && !is_array($param)) {
            throw new \Exception('Argument passed to HashMap must be type of array or instance of Serializable. ' . gettype($param) . ' given.');
        }
        $this->array = $param instanceof Structure ? $param->toArray() : $param;
        $this->iterator = new ArrayList();
        foreach ($param as $key => $item) {
            $this->iterator->push(new KeyValue($key, $item));
        }
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return $this->array;
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
    public function merge($structure)
    {
        $this->array = array_merge($this->array, $structure instanceof Structure ? $structure->toArray() : $structure);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function filter($callable)
    {
        $this->array = array_filter($this->array, $callable);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        $this->array = array();
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function sort($callable)
    {
        usort($this->array, $callable);
        return $this;
    }

    /**
     * @inheritDoc
     * @param mixed $default
     */
    public function get($key, $default = null)
    {
        if (!isset($this->array[$key])) {
            return $default;
        }
        return $this->array[$key];
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value)
    {
        $this->array[$key] = $value;
        $this->iterator->push(new KeyValue($key, $value));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function remove($key)
    {
        unset($this->array[$key]);
        foreach ($this->iterator as $i => $item) {
            if($key == $item->getKey()) {
                $this->iterator->remove($i);
            }
        }
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
    public function contains($value)
    {
        return in_array($value, $this->array);
    }

    /**
     * @inheritDoc
     */
    public function unify()
    {
        $this->array = array_map('unserialize', array_unique(array_map('serialize', $this->array)));
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function iterator()
    {
        return $this->iterator;
    }
}