<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.1.2018
 * Time: 10:40
 */

namespace Zuffik\Test\Srvant\Files;

use Zuffik\Srvant\System\Path;
use PHPUnit\Framework\TestCase;

class PathTest extends TestCase
{
    protected function setUp()
    {
        chdir(__DIR__ . '/../../');
    }

    public function testGetPath()
    {
        $original = new Path('data/original.txt');
        $link = new Path('data/original.txt');
        $this->assertEquals(realpath(getcwd() . '/data/original.txt'), (string) $original);
        $this->assertEquals(realpath(getcwd() . '/data/original.txt'), (string) $link);
        $original = new Path(getcwd() . '/data/original.txt');
        $this->assertEquals(realpath(getcwd() . '/data/original.txt'), (string) $original);
    }
}
