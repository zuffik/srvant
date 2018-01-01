<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 3.12.2017
 * Time: 20:56
 */

namespace Zuffik\Srvant\Generators\Random\Distributions;

/**
 * N(mean, standard deviation)
 * @package Zuffik\Srvant\Generators\Random\Distributions
 */
class NormalDistribution extends Distribution
{
    /**
     * @var UniformDistribution
     */
    private $uniform;
    /**
     * @var float
     */
    private $mean;
    /**
     * @var float
     */
    private $sd;

    /**
     * NormalDistribution constructor.
     * @param float $mean
     * @param float $sd
     */
    public function __construct($mean = 0.0, $sd = 1.0)
    {
        $this->mean = $mean;
        $this->sd = sqrt($sd);
        $this->uniform = new UniformDistribution(0, PHP_INT_MAX);
    }

    /**
     * @return float
     */
    public function nextFloat()
    {
        $x = $this->uniform->nextFloat() / PHP_INT_MAX;
        $y = $this->uniform->nextFloat() / PHP_INT_MAX;
        return sqrt(-2 * log($x)) * cos(2 * pi() * $y) * $this->sd + $this->mean;
    }
}