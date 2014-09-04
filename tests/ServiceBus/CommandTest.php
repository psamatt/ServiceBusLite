<?php

namespace ServiceBus\Tests;

use ServiceBus\Command;

class FooCommand extends Command
{
    public $foo;
    public $bar;
}

class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testArgsPropertySet()
    {
        $fooCommand = new FooCommand(array('foo' => 'Hello', 'bar'=> 'World'));

        $this->assertEquals('Hello', $fooCommand->foo);
        $this->assertEquals('World', $fooCommand->bar);
    }

}