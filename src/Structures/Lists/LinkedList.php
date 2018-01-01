<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 3.6.2017
 * Time: 22:16
 */

namespace Zuffik\Srvant\Structures\Lists;


use Exception;
use Zuffik\Srvant\Structures\OrderedStructure;
use Zuffik\Srvant\Structures\Structure;

class LinkedList extends OrderedStructure
{
    /**
     * @var DataItem
     */
    private $first;
    /**
     * @var DataItem
     */
    private $last;
    /**
     * @var DataItem
     */
    private $current;
    /**
     * @var int
     */
    private $size;

    /**
     * LinkedList constructor.
     * @param array|Structure $param
     * @throws Exception
     */
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->size = 0;
        $this->current = $this->first = $this->last = null;
        if (func_num_args() > 1) {
            $param = func_get_args();
        }
        if (empty($param)) {
            $param = [];
        }
        if (!$param instanceof Structure && !is_array($param)) {
            throw new Exception(
                'Argument #1 of ' . get_class($this) . '::__construct must be an array or instance of Structure. ' .
                (is_object($param) ? 'Instance of ' . get_class($param) : gettype($param)) . ' given'
            );
        }
        foreach ($param instanceof Structure ? $param->toArray() : $param as $value) {
            $this->push($value);
        }
    }

    /**
     * @inheritdoc
     */
    public function map($callable)
    {
        if (is_callable($callable)) {
            $list = new LinkedList();
            /** @var DataItem $item */
            foreach ($this as $i => $item) {
                $res = call_user_func($callable, $item, $i);
                $list->push($res);
            }
            $this->clear();
            $this->merge($list);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function push($value)
    {
        $value = new DataItem($value);
        $last = $this->last;
        if (empty($last)) {
            $this->first = $value;
            $this->last = $value;
        } else if ($this->last === $this->first) {
            $this->last = $value;
            $this->first->setNext($this->last);
        } else {
            $last->setNext($value);
            $this->last = $value;
        }
        $this->size++;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function slice($start = 0, $length = null)
    {
        $list = new LinkedList();
        /**
         * @var int $index
         * @var DataItem $item
         */
        foreach ($this as $index => $item) {
            if($start <= $index && (empty($length) || $index < $length)) {
                $list->push($item->getData());
            }
        }
        $this->clear();
        $this->merge($list);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function sort($callable)
    {
        foreach ($this as $i1 => $v1) {
            foreach ($this as $i2 => $v2) {
                $sort = call_user_func($callable, $v1, $v2);
                if ($sort > 0) {
                    $this->swap($i1, $i2);
                }
            }
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function reverse()
    {
        return $this->sort(function() {
            return 1;
        });
    }

    /**
     * @inheritdoc
     */
    public function diff($array)
    {
        return $this->filter(function($myItem) use($array) {
            $found = false;
            foreach ($array as $otherItem) {
                if($otherItem == $myItem) {
                    $found = true;
                }
            }
            return $found;
        });
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return $this->size;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        $array = [];
        foreach ($this as $item) {
            $array[] = $item;
        }
        return $array;
    }

    /**
     * @inheritdoc
     */
    public function merge($structure)
    {
        foreach ($structure as $item) {
            $this->push($item);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function filter($callable)
    {
        if (is_callable($callable)) {
            $list = new LinkedList();
            /** @var DataItem $item */
            foreach ($this as $i => $item) {
                if (call_user_func($callable, $item, $i)) {
                    $list->push($item);
                }
            }
            $this->clear();
            $this->merge($list);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clear()
    {
        $this->first = $this->last = $this->current = null;
        foreach ($this as $item) {
            unset($item);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        $i = 0;
        $curr = $this->first;
        while($i < $this->size) {
            if ($i++ == $key) {
                return $curr->getData();
            }
            $curr = $curr->getNext();
        }
        throw new Exception("Index out of bounds (size: {$this->count()}, requested: $key)");
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        if ($this->count() == $key) {
            $this->push($value);
        } else if ($this->count() > $key && $key >= 0) {
            foreach ($this as $i => $item) {
                if ($i == $key) {
                    $item->setData($value);
                    return $this;
                }
            }
        }
        throw new Exception("Index out of bounds (size: {$this->count()}, requested: $key)");
    }

    /**
     * @inheritdoc
     */
    public function remove($key)
    {
        /** @var DataItem $item */
        $i = 0;
        $before = $this->first;
        if ($key == 0) {
            $this->first = $this->first->getNext();
        } else if ($key == $this->count() - 1) {
            if ($this->count() == 1) {
                $this->first = $this->last;
                $this->first->setNext(null);
            } else {
                $item = $this->first;
                do {
                    $i++;
                    $item = $item->getNext();
                } while ($i != $this->count() - 2);
                $item->setNext(null);
                unset($this->last);
                $this->last = $item;
            }
        }
        $i = 0;
        $item = $this->first;
        $before = null;
        do {
            $i++;
            $before = $item;
            $item = $item->getNext();
            if ($i == $key) {
                $before->setNext($item->getNext());
                unset($item);
                return $this;
            }
        } while ($i != $this->count() - 1);
        throw new Exception("Index out of bounds ($key requested; {$this->count()} limit)");
    }

    /**
     * @inheritdoc
     */
    public function keyExists($key)
    {
        return $key < $this->count();
    }

    /**
     * @inheritdoc
     */
    public function unify()
    {
        $array = [];
        foreach ($this as $item) {
            $array[] = serialize($item);
        }
        return $this->merge(array_map('unserialize', array_unique($array)));
    }
}