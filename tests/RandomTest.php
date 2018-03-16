<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 10.9.2017
 * Time: 20:23
 */

namespace Zuffik\Test\Srvant;

use PHPUnit\Framework\TestCase;
use Zuffik\Srvant\Formats\Random;
use Zuffik\Srvant\Generators\Random\Distributions;
use Zuffik\Srvant\Generators\Random\Distributions\CombinedDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\ExponentialDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\NormalDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\TriangularDistribution;
use Zuffik\Srvant\Generators\Random\Distributions\UniformDistribution;
use Zuffik\Srvant\Types\Str;

class RandomTest extends TestCase
{
    public function testInterface()
    {
        error_reporting(E_ALL & ~(E_NOTICE | E_WARNING));
        $random = \random();
        $string = $random->string(10);
        $this->assertInstanceOf(Str::class, $string);
        $this->assertEquals(10, $string->length());
        $integer = $random->integer(0, 10);
        $this->assertLessThanOrEqual(10, $integer);
        $this->assertGreaterThanOrEqual(0, $integer);
        $decimal = $random->decimal(0, 10);
        $this->assertLessThanOrEqual(10, $decimal);
        $this->assertGreaterThanOrEqual(0, $decimal);
    }

    public function testDistributions()
    {
        $this->assertEquals(new UniformDistribution(), \random(Distributions::UNIFORM));
        $this->assertEquals(new UniformDistribution(2, 5), \random(Distributions::UNIFORM, 2, 5));
        $this->assertEquals(new TriangularDistribution(1, 3, 2), \random(Distributions::TRIANGULAR, 1, 3, 2));
        $this->assertEquals(new NormalDistribution(), \random(Distributions::NORMAL));
        $this->assertEquals(new NormalDistribution(8, 5), \random(Distributions::NORMAL, 8, 5));
        $this->assertEquals(new ExponentialDistribution(100), \random(Distributions::EXPONENTIAL, 100));
        $this->assertEquals(new ExponentialDistribution(100, 200), \random(Distributions::EXPONENTIAL, 100, 200));

        $combined = \random(Distributions::COMBINED, random(Distributions::UNIFORM), \random(Distributions::UNIFORM), '+-');
        $this->assertEquals(new CombinedDistribution(new UniformDistribution(), new UniformDistribution(), '+-'), $combined);

        $this->assertGreaterThanOrEqual(-1, $combined->nextFloat());
        $this->assertLessThanOrEqual(2, $combined->nextFloat());
    }
}
