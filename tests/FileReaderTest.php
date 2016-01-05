<?php

namespace clagiordano\weblibs\localization\tests;

use clagiordano\weblibs\localization\FileReader;

/**
 * Class FileReaderTest
 * @package clagiordano\weblibs\localization\tests
 */
class FileReaderTest extends \PHPUnit_Framework_TestCase
{
    protected $class;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->class = new FileReader('testdata/messages.po');

        $this->assertInstanceOf(
            'clagiordano\weblibs\localization\FileReader',
            $this->class
        );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testNotExistentFile()
    {
        $this->setExpectedException('Exception');

        $this->class = new FileReader('invalid path');
    }

    public function testNoPermissiontFile()
    {
        $this->markTestIncomplete();

        $this->setExpectedException('Exception');

        $this->class = new FileReader('file with no permission');
    }

    public function testValidFile()
    {
        $this->class = new FileReader('testdata/messages.po');

        $this->assertInstanceOf(
            'clagiordano\weblibs\localization\FileReader',
            $this->class
        );
    }

    public function testReadFile()
    {
        $data = $this->class->read();
        $this->assertInternalType('string', $data);
    }

    public function testFileLength()
    {
        $len = $this->class->length();
        $this->assertInternalType('integer', $len);
        $this->assertTrue($len > 0);
    }

    public function testReadFileSeeked()
    {
        $this->class = new FileReader('testdata/messages.po');

        $this->assertInstanceOf(
            'clagiordano\weblibs\localization\FileReader',
            $this->class
        );

        // start in the middle of the file
        $seekPosition = $this->class->seekTo($this->class->length() / 2);
        $this->assertInternalType('integer', $seekPosition);
        $this->assertEquals(
            ($this->class->length() / 2),
            $seekPosition
        );

        $this->assertEquals(
            $this->class->currentPos(),
            $seekPosition
        );

        $data = $this->class->read();
        $this->assertInternalType('string', $data);
    }
}