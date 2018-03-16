<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.10.2017
 * Time: 0:45
 */

namespace Zuffik\Test\Srvant;

use PHPUnit\Framework\TestCase;
use Zuffik\Srvant\System\Files\File;
use Zuffik\Srvant\System\Path;

class CSVTest extends TestCase
{
    public function testNativeResource()
    {
        $handle = fopen(__DIR__ . '/../data/example.csv', 'r');
        $this->useHandle($handle);
        fclose($handle);
    }

    public function testFileClass()
    {
        $handle = new File('data/example.csv');
        $this->useHandle($handle);
        $handle->close();
    }

    public function testPathClass()
    {
        $handle = new Path('data/example.csv');
        $this->useHandle($handle);
    }

    private function useHandle($handle)
    {
        $csv = csv($handle, ';', '"', '\\', false);
        foreach ($csv as $i => $item) {
            if ($i % 2 == 0) {
                $this->assertEquals(arrayList(['foo', 'bar', 5, 6.7]), arrayList($item));
            } else {
                $this->assertEquals(arrayList(["yo", "ma", 7, 8.8]), arrayList($item));
            }
        }
    }
}
