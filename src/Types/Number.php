<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 8.8.2017
 * Time: 6:49
 */

namespace Zuffik\Srvant\Types;

use Zuffik\Srvant\Exceptions\InvalidArgumentException;

/**
 * Any number wrapper
 * @package Zuffik\Srvant\Types
 */
abstract class Number
{
    /**
     * @var float|int
     */
    protected $value;

    /**
     * Number constructor.
     * @param float|int|\Zuffik\Srvant\Types\Number $value
     */
    public function __construct($value = 0)
    {
        if ($value instanceof Number) {
            $this->value = $value->getValue();
        }
        $this->value = $value;
    }

    /**
     * @param int|float $value
     * @return \Zuffik\Srvant\Types\Double|\Zuffik\Srvant\Types\Integer
     * @throws InvalidArgumentException
     */
    public static function create($value)
    {
        return is_float($value) ? new Double($value) : new Integer($value);
    }

    /**
     * @param float|int $value
     * @return \Zuffik\Srvant\Types\Number
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return float|int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return float|int
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * @param Number|int|float $number
     * @return \Zuffik\Srvant\Types\Number
     */
    public function add($number)
    {
        $this->value += $number;
        return $this;
    }

    /**
     * @param Number|int|float $number
     * @return \Zuffik\Srvant\Types\Number
     */
    public function subtract($number)
    {
        $this->value -= $number;
        return $this;
    }

    /**
     * @param Number|int|float $number
     * @return \Zuffik\Srvant\Types\Number
     */
    public function multiply($number)
    {
        $this->value *= $number;
        return $this;
    }

    /**
     * @param \Zuffik\Srvant\Types\Number|int|float $number
     * @return \Zuffik\Srvant\Types\Number
     */
    public function divide($number)
    {
        $this->value /= $number;
        return $this;
    }

    /**
     * @return \Zuffik\Srvant\Types\Number
     */
    public function abs()
    {
        $this->value = abs($this->value);
        return $this;
    }


    /**
     * @param int $decimals
     * @param string $decimalDelimiter
     * @param string $thousandsDelimiter
     * @return string
     */
    public function numberFormat($decimals = 0, $decimalDelimiter = ".", $thousandsDelimiter = ",")
    {
        return number_format($this->value, $decimals, $decimalDelimiter, $thousandsDelimiter);
    }


}