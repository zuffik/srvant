<?php
/**
 * Created by PhpStorm.
 * User: zuffik
 * Date: 31.1.2018
 * Time: 11:05
 */

namespace Zuffik\Test\Srvant\Files;

use Zuffik\Srvant\System\Files\Directory;
use Zuffik\Srvant\System\Files\File;
use PHPUnit\Framework\TestCase;
use Zuffik\Srvant\System\Files\Stream;

class FileInfoTest extends TestCase
{

    protected function setUp()
    {
        chdir(__DIR__ . '/../../');
    }

    public function testFile()
    {
        $file = new File('hello/world.txt');
        $this->assertFalse($file->exists());
        $o = new File('data/original.txt');
        $this->assertTrue($o->exists());
        $this->assertEquals('This is original file', $o->read());
        $o->write('This is test');
        $this->assertEquals('This is test', $o->read());
        $o->append('ing');
        $this->assertEquals('This is testing', $o->read());
        $this->assertFalse($o->isOpen());
        $o->open(Stream::READ);
        $this->assertTrue($o->isOpen());
        $this->assertNotEmpty($o->getResource());
        $o->close();
        $this->assertFalse($o->isOpen());
        $o->write('This is original file');
    }

    public function testDirectory()
    {
        $b = new Directory('hello/');
        $this->assertFalse($b->exists());
        $dir = new Directory('.');
        $this->assertTrue($dir->exists());
        $dir = new Directory('../../data/original.txt');
        $this->assertFalse($dir->exists());
    }
}
