<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 4.10.2017
 * Time: 12:11
 */

namespace Zuffik\Test\Srvant;

use PHPUnit\Framework\TestCase;
use Zuffik\Srvant\Structures\Maps\HashMap;
use Zuffik\Srvant\Structures\OrderedStructure;

class StructuresTest extends TestCase
{
    /**
     * @var array
     */
    private $listProto = [];
    /**
     * @var array
     */
    private $mapProto = [];

    /**
     * @throws \Zuffik\Srvant\Exceptions\InvalidArgumentException
     */
    protected function setUp()
    {
        parent::setUp();
        $this->listProto = [
            new HashMap([
                'int' => 1,
                'float' => 8.0,
                'char' => 'b',
            ]),
            [
                'int' => 3,
                'float' => 7.7,
                'char' => 'a',
            ],
            [
                'int' => 1,
                'float' => 9.5,
                'char' => 'b',
            ],
        ];
        $this->mapProto = [
            'a' => [
                'int' => 2,
                'float' => 4.4,
                'char' => 'f',
            ],
            'b' => [
                'int' => 1,
                'float' => 7.6,
                'char' => 'f',
            ],
            'c' => [
                'int' => 3,
                'float' => 1.8,
                'char' => 'c',
            ],
        ];
    }

    /**
     * @throws \Zuffik\Srvant\Exceptions\InvalidArgumentException
     */
    public function testArrayList()
    {
        $this->listTest(\arrayList($this->listProto));
    }

    /*public function testLinkedList()
    {
        $this->listTest(\linkedList($this->listProto));
    }*/

    /**
     * @param OrderedStructure $list
     * @throws \Zuffik\Srvant\Exceptions\InvalidArgumentException
     */
    private function listTest(OrderedStructure $list)
    {
        $this->assertEquals(new HashMap([
            'int' => 1,
            'float' => 8.0,
            'char' => 'b',
        ]), $list->find('b', ['char']));
        $this->assertEquals(0, $list->indexOf('b', ['char']));
        $this->assertEquals([
            [
                'int' => 3,
                'float' => 7.7,
                'char' => 'a',
            ],
            new HashMap([
                'int' => 1,
                'float' => 8.0,
                'char' => 'b',
            ]),
            [
                'int' => 1,
                'float' => 9.5,
                'char' => 'b',
            ],
        ], $list->copy()->sort(function ($i1, $i2) {
            return $i1['float'] > $i2['float'];
        })->toArray());
        $this->assertEquals([
            [
                'int' => 3,
                'float' => 7.7,
                'char' => 'a',
            ],
            new HashMap([
                'int' => 1,
                'float' => 8.0,
                'char' => 'b',
            ]),
            [
                'int' => 1,
                'float' => 9.5,
                'char' => 'b',
            ],
        ], $list->copy()->multiSort(['int' => 'desc', 'float' => 'asc'])->toArray());
        $this->assertEquals([
            'b' => [
                new HashMap([
                    'int' => 1,
                    'float' => 8.0,
                    'char' => 'b',
                ]),
                [
                    'int' => 1,
                    'float' => 9.5,
                    'char' => 'b',
                ],
            ],
            'a' => [
                [
                    'int' => 3,
                    'float' => 7.7,
                    'char' => 'a',
                ],
            ]
        ], $list->copy()->categorize('char')->toArray());
        $this->assertEquals([
            [
                'int' => 3,
                'float' => 7.7,
                'char' => 'a',
            ],
            new HashMap([
                'int' => 1,
                'float' => 8.0,
                'char' => 'b',
            ]),
            [
                'int' => 1,
                'float' => 9.5,
                'char' => 'b',
            ],
        ], $list->copy()->swap(0, 1)->toArray());
        $this->assertEquals(2, $list->countIf(function ($item) {
            return $item['char'] == 'b';
        }));
    }

    /**
     * @throws \Zuffik\Srvant\Exceptions\InvalidArgumentException
     */
    public function testJSON()
    {
        $this->assertEquals(json_encode(['foo' => 'bar']), json_encode(\hashMap(['foo' => 'bar'])));
        $this->assertEquals(json_encode(['foo', 'bar']), json_encode(\linkedList(['foo', 'bar'])));
    }
}
