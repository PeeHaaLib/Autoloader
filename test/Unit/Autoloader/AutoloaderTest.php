<?php

namespace PeeHaaLibTest\Unit\Autoloader;

use PeeHaaLib\Autoloader\Psr0;

class Psr0Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PeeHaaLib\Autoloader\Psr0::__construct
     */
    public function testConstructCorrectInstance()
    {
        $autoloader = new Psr0('Test', '/');

        $this->assertInstanceOf('\\PeeHaaLib\\Autoloader\\Psr0', $autoloader);
    }

    /**
     * @covers PeeHaaLib\Autoloader\Psr0::__construct
     * @covers PeeHaaLib\Autoloader\Psr0::register
     */
    public function testRegister()
    {
        $autoloader = new Psr0('Test', '/');

        $this->assertTrue($autoloader->register());
    }

    /**
     * @covers PeeHaaLib\Autoloader\Psr0::__construct
     * @covers PeeHaaLib\Autoloader\Psr0::register
     * @covers PeeHaaLib\Autoloader\Psr0::unregister
     */
    public function testUnregister()
    {
        $autoloader = new Psr0('Test', '/');

        $this->assertTrue($autoloader->register());
        $this->assertTrue($autoloader->unregister());
    }

    /**
     * @covers PeeHaaLib\Autoloader\Psr0::__construct
     * @covers PeeHaaLib\Autoloader\Psr0::register
     * @covers PeeHaaLib\Autoloader\Psr0::load
     */
    public function testLoadSuccess()
    {
        $autoloader = new Psr0('FakeProject', dirname(__DIR__) . '/../Mocks');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers PeeHaaLib\Autoloader\Psr0::__construct
     * @covers PeeHaaLib\Autoloader\Psr0::register
     * @covers PeeHaaLib\Autoloader\Psr0::load
     */
    public function testLoadSuccessExtraSlashedNamespace()
    {
        $autoloader = new Psr0('\\\\FakeProject', dirname(__DIR__) . '/../Mocks');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers PeeHaaLib\Autoloader\Psr0::__construct
     * @covers PeeHaaLib\Autoloader\Psr0::register
     * @covers PeeHaaLib\Autoloader\Psr0::load
     */
    public function testLoadSuccessExtraForwardSlashedPath()
    {
        $autoloader = new Psr0('FakeProject', dirname(__DIR__) . '/../Mocks//');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers PeeHaaLib\Autoloader\Psr0::__construct
     * @covers PeeHaaLib\Autoloader\Psr0::register
     * @covers PeeHaaLib\Autoloader\Psr0::load
     */
    public function testLoadSuccessExtraBackwardSlashedPath()
    {
        $autoloader = new Psr0('FakeProject', dirname(__DIR__) . '/../Mocks\\');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers PeeHaaLib\Autoloader\Psr0::__construct
     * @covers PeeHaaLib\Autoloader\Psr0::register
     * @covers PeeHaaLib\Autoloader\Psr0::load
     */
    public function testLoadSuccessExtraMixedSlashedPath()
    {
        $autoloader = new Psr0('FakeProject', dirname(__DIR__) . '/../Mocks\\\\/\\//');

        $this->assertTrue($autoloader->register());

        $someClass = new \FakeProject\NS\SomeClass();

        $this->assertTrue($someClass->isLoaded());
    }

    /**
     * @covers PeeHaaLib\Autoloader\Psr0::__construct
     * @covers PeeHaaLib\Autoloader\Psr0::register
     * @covers PeeHaaLib\Autoloader\Psr0::load
     */
    public function testLoadUnknownClass()
    {
        $autoloader = new Psr0('FakeProject', dirname(__DIR__) . '/../Mocks\\\\/\\//');

        $this->assertTrue($autoloader->register());

        $this->assertFalse($autoloader->load('IDontExistClass'));
    }
}
