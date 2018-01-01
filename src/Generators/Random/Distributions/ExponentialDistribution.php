<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 2.12.2017
 * Time: 10:23
 */

namespace Zuffik\Srvant\Generators\Random\Distributions;

/**
 * E(lambda, tau = 100)
 * @package Zuffik\Srvant\Generators\Random\Distributions
 */
class ExponentialDistribution extends Distribution
{
    /**
     * @var float
     */
    private $lambda;
    /**
     * @var float|int
     */
    private $tau;
    /**
     * @var UniformDistribution
     */
    private $uniformDistribution;

    /**
     * ExponentialDistribution constructor.
     * @param float $lambda
     * @param int|float $tau
     */
    public function __construct($lambda, $tau = 100)
    {
        $this->lambda = $lambda;
        $this->tau = $tau;
        $this->uniformDistribution = new UniformDistribution();
    }

    /**
     * @return float
     */
    public function nextFloat()
    {
        $u = $this->uniformDistribution->nextFloat();
        return - log(1 - (1 - exp(- $this->lambda * $this->tau)) * $u) / $this->lambda;
    }
}