<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 2.12.2017
 * Time: 10:45
 */

namespace Zuffik\Test\Srvant;

use PHPUnit\Framework\TestCase;
use Zuffik\Srvant\Generators\Random\Distributions\CombinedDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\ExponentialDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\NormalDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\TriangularDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\UniformDistribution;

class DistributionTest extends TestCase
{
    public function testUniform()
    {
        $dist = new UniformDistribution(0, 3);
        for ($i = 0; $i < 10; $i++) {
            $this->assertFinite($dist->nextFloat());
            $this->assertGreaterThanOrEqual(0, $dist->nextFloat());
            $this->assertLessThanOrEqual(3, $dist->nextFloat());
        }
    }

    public function testExponential()
    {
        $dist = new ExponentialDistribution(2);
        for ($i = 0; $i < 100; $i++) {
            $this->assertFinite($dist->nextFloat());
            $this->assertGreaterThanOrEqual(0, $dist->nextFloat());
        }
    }

    public function testNormal()
    {
        $dist = new NormalDistribution();
        for ($i = 0; $i < 100; $i++) {
            $this->assertFinite($dist->nextFloat());
            /* Not probable values -5, 5. But nextFloat CAN return any other number. */
            $this->assertGreaterThanOrEqual(-5, $dist->nextFloat());
            $this->assertLessThanOrEqual(5, $dist->nextFloat());
        }
    }

    public function testCombined()
    {
        $dist = new CombinedDistribution(new ExponentialDistribution(1 / 10), new UniformDistribution(0, 1));
        for($i = 0; $i < 100; $i++) {
            $this->assertFinite($dist->nextFloat());
            $this->assertGreaterThanOrEqual(-1, $dist->nextFloat());
        }
    }

    public function testTriangular()
    {
        $dist = new TriangularDistribution(1, 3, 2);
        for($i = 0; $i < 100; $i++) {
            $this->assertFinite($dist->nextFloat());
            $this->assertGreaterThanOrEqual(1, $dist->nextFloat());
            $this->assertLessThanOrEqual(3, $dist->nextFloat());
        }
    }
}
