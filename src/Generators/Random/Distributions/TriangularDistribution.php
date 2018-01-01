<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 5.12.2017
 * Time: 13:26
 */

namespace Zuffik\Srvant\Generators\Random\Distributions;

/**
 * TRI(minimum, maximum, mode)
 * @package Zuffik\Srvant\Generators\Random\Distributions
 */
class TriangularDistribution extends Distribution
{
    /**
     * @var float
     */
    private $min;
    /**
     * @var float
     */
    private $max;
    /**
     * @var float
     */
    private $mode;
    /**
     * @var UniformDistribution
     */
    private $uniform;

    /**
     * TriangularDistribution constructor.
     * @param float $min
     * @param float $max
     * @param float $mode
     */
    public function __construct($min, $max, $mode)
    {
        $this->min = $min;
        $this->max = $max;
        $this->mode = $mode;
        $this->uniform = new UniformDistribution();
    }

    /**
     * @inheritdoc
     */
    public function nextFloat()
    {
        $u = $this->uniform->nextFloat();
        return $u < ($this->mode - $this->min) / ($this->max - $this->min) ?
            $this->min + sqrt(($this->max - $this->min) * ($this->mode - $this->min) * $u) :
            $this->max - sqrt(($this->max - $this->min) * ($this->max - $this->mode) * (1 - $u));
    }
}