<?php

namespace ServiceBus\Tests;

use ServiceBus\Query;

class FooQuery extends Query
{
    public $foo;
    public $bar;
}

class QueryTest extends \PHPUnit_Framework_TestCase
{
    public function testArgsPropertySet()
    {
        $fooQuery = new FooQuery(array('foo' => 'Hello', 'bar'=> 'World'));

        $this->assertEquals('Hello', $fooQuery->foo);
        $this->assertEquals('World', $fooQuery->bar);
    }

}