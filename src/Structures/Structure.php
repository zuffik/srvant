<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 10.12.2016
 * Time: 23:05
 */

namespace Zuffik\Srvant\Structures;


use ArrayAccess;
use Countable;
use Exception;
use JsonSerializable;

/**
 * Interface Structure. Every structure should manage its items.
 * Every structure should have ability to access its items via [], every structure should have ability
 * to be converted to JSON and should have ability to know its size.
 * @package Zuffik\Srvant\Structures
 */
interface Structure extends Countable, ArrayAccess, JsonSerializable, IArray
{
    /**
     * Structure constructor.
     * @param static|array|null $param standard or copy constructor
     */
    public function __construct($param = null);

    /**
     * Merges List with array or a structure
     * @param Structure|array $structure
     * @return Structure
     * @throws Exception
     */
    public function merge($structure);

    /**
     * Filters items by given callable (param: $item, returns: bool whether item stays in list or will be removed)
     * @param callable|string $callable
     * @return Structure
     */
    public function filter($callable);

    /**
     * Removes all items from List.
     * @return static
     */
    public function clear();

    /**
     * Sort List by given callable (params: $item1, $item2)
     * @param callable|string $callable
     * @return Structure
     */
    public function sort($callable);

    /**
     * Returns item from given key
     * @param mixed $key
     * @return mixed
     * @throws Exception
     */
    public function get($key);

    /**
     * Sets an offset to value
     * @param mixed $key
     * @param mixed $value
     * @return Structure
     */
    public function set($key, $value);

    /**
     * Removes item from List by its key.
     * @param mixed $key
     * @return Structure
     */
    public function remove($key);

    /**
     * Return new instance with same content.
     * @return Structure
     */
    public function copy();

    /**
     * Whether List is empty.
     * @return bool (usually size == 0)
     */
    public function isEmpty();

    /**
     * @param mixed $index1
     * @param mixed $index2
     * @return Structure
     */
    public function swap($index1, $index2);

    /**
     * @param mixed $key
     * @return bool
     */
    public function keyExists($key);

    /**
     * Whether value exists in structure
     * @param mixed $value
     * @return bool
     */
    public function contains($value);

    /**
     * Makes structure values unique
     * @return Structure
     */
    public function unify();

    /**
     * Iterates over each item in List and pass it in closure
     * (param: $item, $key, returns: mixed - value that will be replaced in list)
     * @param callable $callable
     * @return Structure
     */
    public function map($callable);

    /**
     * @param mixed $value
     * @param bool $firstOnly
     * @return Structure
     */
    public function removeByValue($value, $firstOnly = true);
}