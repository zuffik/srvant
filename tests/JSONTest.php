<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.1.2018
 * Time: 11:39
 */

namespace Zuffik\Test\Srvant;

use PHPUnit\Framework\TestCase;
use Zuffik\Srvant\Formats\JSON;
use Zuffik\Srvant\System\Files\File;
use Zuffik\Srvant\System\Path;

class JSONTest extends TestCase
{
    public function testNativeResource()
    {
        $handle = fopen(__DIR__ . '/../data/example.json', 'r');
        $this->useHandle($handle);
        fclose($handle);
    }

    public function testFileClass()
    {
        $handle = new File('data/example.json');
        $this->useHandle($handle);
        $handle->close();
    }

    public function testPathClass()
    {
        $handle = new Path('data/example.json');
        $this->useHandle($handle);
    }

    public function testArray()
    {
        $this->useHandle([
            'users' => [
                [
                    'id' => 1,
                    'name' => 'Jozef'
                ],
                [
                    'id' => 5,
                    'name' => 'John'
                ]
            ],
            'foo' => 4
        ]);
    }

    private function useHandle($handle)
    {
        $json = new JSON($handle);
        $this->assertEquals('{"users":[{"id":1,"name":"Jozef"},{"id":5,"name":"John"}],"foo":4}', (string) $json);
    }
}
