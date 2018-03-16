<?php
/**
 * Created by PhpStorm.
 * User: zuffa
 * Date: 9.8.2016
 * Time: 14:37
 */

namespace Zuffik\Srvant\Types;


use ReflectionClass;
use Zuffik\Srvant\Exceptions\ErrorException;
use Zuffik\Srvant\Exceptions\InvalidArgumentException;
use Zuffik\Srvant\Structures\IArray;
use Zuffik\Srvant\Structures\Maps\HashMap;

/**
 * Enumerator
 * Usage:
 * ```php
 * class Example extends Enum {
 *  const C_1 = 1;
 *  const C_2 = 2;
 * };
 * // good:
 * $enum = new Example(Example::C_1);
 * // bad (exception):
 * $enum = new Example('a');
 * ```
 * @package Zuffik\Srvant\Types
 */
abstract class Enum implements IArray
{
    /** @var mixed */
    private $value;
    /** @var array */
    private $constants;

    /**
     * Enum constructor.
     * @param $value
     * @throws ErrorException
     * @throws InvalidArgumentException
     */
    public function __construct($value)
    {
        try {
            $this->constants = new HashMap((new ReflectionClass($this))->getConstants());
        } catch (\ReflectionException $e) {
            throw new ErrorException($e->getMessage(), $e->getCode(), $e);
        }
        $this->setValue($value);
    }

    /**
     * Return all values
     * @return HashMap
     * @throws ErrorException
     * @throws InvalidArgumentException
     */
    public static function getValues()
    {
        try {
            return new HashMap((new ReflectionClass(self::class))->getConstants());
        } catch (\ReflectionException $e) {
            throw new ErrorException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Setter for value
     * @param mixed $value
     * @return Enum
     * @throws InvalidArgumentException
     */
    public function setValue($value)
    {
        if (!in_array($value, $this->constants->toArray())) {
            throw new InvalidArgumentException('Could not read ' . $value . ' constant of enum ' . get_class($this));
        }
        $this->value = $value;
        return $this;
    }

    /**
     * Returns value of enumerator
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns possible values
     * @return HashMap
     */
    public function toArray()
    {
        return $this->constants;
    }

    /**
     * If $value can be passed in enumerator returns it. Otherwise it throws an exception.
     * @param $value
     * @return mixed
     * @throws ErrorException
     * @throws InvalidArgumentException
     */
    public static function verify($value)
    {
        return (new static($value))->getValue();
    }
}