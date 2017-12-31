<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 2.12.2017
 * Time: 10:20
 */

namespace Zuffik\Structures\Generators\Random\Distributions;


abstract class Distribution
{

    /**
     * @return float
     */
    public abstract function nextFloat();

    /**
     * @return int
     */
    public function nextInt()
    {
        return round($this->nextFloat());
    }

    /**
     * @return string
     */
    public function nextChar()
    {
        return chr($this->nextInt());
    }

    /**
     * @return \Generator|int[]
     */
    public function getIntegers()
    {
        yield $this->nextInt();
    }

    /**
     * @return \Generator|float[]
     */
    public function getFloats()
    {
        yield $this->nextFloat();
    }

    /**
     * @return \Generator|string
     */
    public function getCharacters()
    {
        yield $this->nextChar();
    }
}