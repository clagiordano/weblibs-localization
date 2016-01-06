<?php

namespace clagiordano\weblibs\localization\tests;

use clagiordano\weblibs\localization\StringReader;

/**
 * Class StringReaderTest
 * @package clagiordano\weblibs\localization\tests
 */
class StringReaderTest extends \PHPUnit_Framework_TestCase
{
    protected $class;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $fileConent = file_get_contents('testdata/messages.po');
        $this->class = new StringReader($fileConent);

        $this->assertInstanceOf(
            'clagiordano\weblibs\localization\StringReader',
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