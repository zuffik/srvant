<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 16.3.2018
 * Time: 12:27
 */

namespace Zuffik\Srvant\Generators\Random;


use Zuffik\Srvant\Generators\Random\Distributions\CombinedDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\ExponentialDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\NormalDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\TriangularDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\UniformDistribution;
use Zuffik\Srvant\Types\Enum;

class Distributions extends Enum
{
    const COMBINED = CombinedDistribution::class;
    const EXPONENTIAL = ExponentialDistribution::class;
    const NORMAL = NormalDistribution::class;
    const TRIANGULAR = TriangularDistribution::class;
    const UNIFORM = UniformDistribution::class;

    const SYSTEM = Random::class;
}