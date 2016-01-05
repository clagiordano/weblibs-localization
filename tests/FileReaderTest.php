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

    public function testStart()
    {
        //$this->markTestIncomplete();
    }
}