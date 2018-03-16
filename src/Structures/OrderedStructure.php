<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 3.6.2017
 * Time: 21:59
 */

namespace Zuffik\Srvant\Structures;


use Generator;
use Iterator;
use Zuffik\Srvant\Exceptions\InvalidArgumentException;
use Zuffik\Srvant\Helpers\Finder;
use Zuffik\Srvant\Helpers\RecursiveGetter;
use Zuffik\Srvant\Structures\Maps\HashMap;
use Zuffik\Srvant\Types\Str;

/**
 * Class ListStructure represents List.
 * @package Zuffik\Srvant\Structures\Lists
 */
abstract class OrderedStructure extends AbstractStructure implements Iterator
{
    /**
     * @var int
     */
    protected $key;

    /**
     * @inheritDoc
     */
    public function __construct($param = null)
    {
        parent::__construct($param);
        $this->rewind();
    }

    /**
     * Add value to end of List
     * @param mixed $value
     * @return OrderedStructure
     */
    public abstract function push($value);

    /**
     * Add value to beginning of List
     * @param mixed $value
     * @return OrderedStructure
     */
    public abstract function pushFirst($value);


    /**
     * Removes last item from List and returns it.
     * @return mixed
     */
    public function pop()
    {
        $val = $this[$this->count() - 1];
        unset($this[$this->count() - 1]);
        return $val;
    }

    /**
     * Get last item from array.
     * @return mixed
     */
    public function last()
    {
        return $this[$this->count() - 1];
    }

    /**
     * Get first item from array.
     * @return mixed
     */
    public function first()
    {
        return $this[0];
    }

    /**
     * Makes subset from List by its start index and length of subset
     * @param int $start
     * @param int $length
     * @return OrderedStructure
     */
    public abstract function slice($start = 0, $length = null);

    /**
     * Sort List by given callable (params: $item1, $item2)
     * @param callable|string $callable
     * @return OrderedStructure
     */
    public abstract function sort($callable);

    /**
     * Reverses List.
     * @return OrderedStructure
     */
    public abstract function reverse();

    /**
     * Computes the difference of arrays
     * @param array|OrderedStructure $array
     * @return OrderedStructure
     */
    public abstract function diff($array);

    /**
     * Recursively searches for item in List. If no item was found, null is returned.
     * @param mixed $search a value to search
     * @param callable|null $method a method to call on iterated value to compare with $search
     * @param bool $strict whether to use == or ===
     * @return mixed|null
     * @throws \Zuffik\Srvant\Exceptions\InvalidArgumentException
     */
    public function find($search, $method = null, $strict = false)
    {
        return Finder::find($this, $search, $method, $strict, true);
    }

    /**
     * Recursively searches for items in List. If no item was found, empty List is returned.
     * @param mixed $search a value to search
     * @param callable|null $method a method to call on iterated value to compare with $search
     * @param bool $strict whether to use == or ===
     * @return OrderedStructure a COPY of itself
     * @throws \Zuffik\Srvant\Exceptions\InvalidArgumentException
     */
    public function findAll($search, $method = null, $strict = false)
    {
        return new static(Finder::find($this, $search, $method, $strict, false));
    }

    /**
     * Sort by multiple criteria
     * (assoc. array with key representing what will be compared and
     * value representing in which order it will be moved)
     * @param string[] $criteria
     * @return OrderedStructure
     */
    public function multiSort($criteria = [])
    {
        return $this->sort(function ($v1, $v2) use ($criteria) {
            foreach ($criteria as $what => $order) {
                $val1 = RecursiveGetter::get($v1, $what);
                $val2 = RecursiveGetter::get($v2, $what);
                if ($val1 == $val2) {
                    continue;
                }
                return ($order == 'desc' ? -1 : 1) * strcmp($val1, $val2);
            }
            return 0;
        });
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this[$this->key];
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->key++;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return $this->key < $this->count();
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->key = 0;
    }

    /**
     * Recursively joins items in List by given glue.
     * @param string|Str $glue
     * @return Str
     */
    public function join($glue = '')
    {
        return $this->joinLevel($glue, $this);
    }

    /**
     * @param string|Str $glue
     * @param OrderedStructure $level
     * @return Str
     */
    private function joinLevel($glue, $level)
    {
        $level = $level instanceof Structure ? $level->toArray() : $level;
        foreach ($level as $i => $item) {
            if (is_array($item) || $item instanceof OrderedStructure) {
                $level[$i] = $this->joinLevel($glue, $item);
            } else if (is_object($item) && !method_exists($item, '__toString') && !$item instanceof OrderedStructure) {
                $level[$i] = get_class($item);
            } else {
                $level[$i] = (string)$item;
            }
        }
        return new Str(implode((string)$glue, $level));
    }

    /**
     * yields each item
     * @return Generator
     */
    public function getGenerator()
    {
        foreach ($this as $item) {
            yield $item;
        }
    }

    /**
     * Returns hash map with given categorization, eg.
     * ```php
     * $list = new ArrayList([
     *  ['foo' => 'bar', 'a' => 1],
     *  ['foo' => 'baz', 'a' => 2],
     *  ['foo' => 'bar', 'a' => 3]
     * ]);
     * $list->categorize('foo');
     * // returns hashmap
     * [
     *  'bar' => [
     *    ['foo' => 'bar', 'a' => 1],
     *    ['foo' => 'bar', 'a' => 3]
     *  ],
     *  'baz' => [
     *    ['foo' => 'baz', 'a' => 2]
     *  ]
     * ]
     * ```
     * @param callable|callable[]|string|string[] $criteria
     * @return HashMap
     * @throws InvalidArgumentException
     */
    public function categorize($criteria)
    {
        if (!is_array($criteria)) {
            $criteria = [$criteria];
        }
        $result = [];
        foreach ($criteria as $criterion) {
            foreach ($this as $k => $item) {
                if (is_callable($criterion)) {
                    $key = call_user_func($criterion, $item, $k);
                } else if (is_object($item) && method_exists($item, $criterion)) {
                    $key = call_user_func([$item, $criterion]);
                } else if (is_array($item) || $item instanceof \ArrayAccess) {
                    $key = $item[$criterion];
                } else {
                    throw new InvalidArgumentException('Categorize by unknown way.');
                }
                if (empty($result[$key])) {
                    $result[$key] = [];
                }
                $result[$key][] = $item;
            }
        }
        return new HashMap($result);
    }

    /**
     * Returns random item from List.
     * @return mixed
     */
    public function rand()
    {
        return $this[rand(0, $this->count() - 1)];
    }


    /**
     * Removes item from List by comparing its value
     * @param mixed $value
     * @param bool $stopAtFirst
     * @return OrderedStructure
     */
    public function removeIf($value, $stopAtFirst = false)
    {
        foreach ($this as $index => $item) {
            if ($value == $item) {
                unset($this[$index]);
                if ($stopAtFirst) {
                    break;
                }
            }
        }
        return $this;
    }

    /**
     * Counts every item that meets condition in callable (params: $value, $index)
     * @param callable|string|\Closure $callable
     * @return int
     */
    public function countIf($callable)
    {
        $c = 0;
        foreach ($this as $key => $value) {
            if (call_user_func($callable, $value, $key)) {
                $c++;
            }
        }
        return $c;
    }

    /**
     * Sum every item that meets condition in callable (params: $value, $index)
     * @param callable|string|\Closure $callable
     * @return int
     */
    public function sumIf($callable)
    {
        $s = 0;
        foreach ($this as $key => $value) {
            if (call_user_func($callable, $value, $key)) {
                $s += $value;
            }
        }
        return $s;
    }

    /**
     * Returns sum of List items.
     * @return float
     */
    public function sum()
    {
        return $this->sumIf(function () {
            return true;
        });
    }

    /**
     * Returns minimum of List items.
     * @return float
     */
    public function min()
    {
        $min = PHP_INT_MAX;
        foreach ($this as $item) {
            if ($item < $min) {
                $min = $item;
            }
        }
        return $min;
    }

    /**
     * Returns maximum of List items.
     * @return float
     */
    public function max()
    {
        $max = 0;
        foreach ($this as $item) {
            if ($item < $max) {
                $max = $item;
            }
        }
        return $max;
    }

    /**
     * @inheritDoc
     */
    public function contains($value)
    {
        return !empty($this->find($value));
    }

    /**
     * @inheritDoc
     */
    public function __sleep()
    {
        foreach ($this as $item) {
            if (is_object($item) && method_exists($item, '__sleep')) {
                $item->__sleep();
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function __wakeup()
    {
        foreach ($this as $item) {
            if (is_object($item) && method_exists($item, '__wakeup')) {
                $item->__wakeup();
            }
        }
    }

    /**
     * Searches for index of given element
     * @param mixed $search
     * @param string|string[] $method
     * @param bool $strict
     * @return int
     * @throws InvalidArgumentException
     */
    public function indexOf($search, $method, $strict = false)
    {
        return Finder::find($this, $search, $method, $strict, true, true);
    }
}