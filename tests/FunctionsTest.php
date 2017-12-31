<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 8.8.2017
 * Time: 14:28
 */

namespace Zuffik\Test\Srvant;

use PHPUnit\Framework\TestCase;
use Zuffik\Srvant\Data\ArrayList;
use Zuffik\Srvant\Data\HashMap;
use Zuffik\Srvant\Data\LinkedList;
use Zuffik\Srvant\Formats\JSON;
use Zuffik\Srvant\Formats\Random;
use Zuffik\Srvant\Formats\Regex;
use Zuffik\Srvant\Types\Double;
use Zuffik\Srvant\Types\Integer;
use Zuffik\Srvant\Types\Number;
use Zuffik\Srvant\Types\Str;

class FunctionsTest extends TestCase
{
    public function test()
    {
        $this->assertEquals(new Str('test'), string('test'));
        $this->assertEquals(new Regex('/^a$/'), regex('/^a$/'));
        $this->assertEquals(new JSON('{"a":"b"}'), json('{"a":"b"}'));
        $this->assertEquals(new ArrayList([1, 2]), arrayList([1, 2]));
        $this->assertEquals(new LinkedList([1, 2]), linkedList([1, 2]));
        $this->assertEquals(new HashMap([1 => 2]), hashMap([1 => 2]));
        $this->assertEquals(Number::create(1), number(1));
        $this->assertEquals(Number::create(1.1), number(1.1));
        $this->assertEquals(new Integer(1), integer(1));
        $this->assertEquals(new Double(1.1), double(1.1));
        $this->assertEquals(new Random(), \random());
    }

    public function testNotValidRegex()
    {
        $this->expectException(\InvalidArgumentException::class);
        regex('this is not valid regex');
    }

    public function testNotValidJson()
    {
        $this->expectException(\InvalidArgumentException::class);
        json('this is not valid json');
    }
}
