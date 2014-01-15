<?php

namespace ServiceBus\Tests;

use ServiceBus\Mediator;

class MediatorTest extends \PHPUnit_Framework_TestCase
{
    public function testValidRequestQuery()
    {
        $queryHandlerMock = $this->getMock('ServiceBus\IQueryHandler', array('handle'));
        $queryHandlerMock->expects($this->once())
            ->method('handle')
            ->will($this->returnValue($returned = 'abc'));
        
        $memoryBusHandlerResolverMock = $this->getMock('ServiceBus\ServiceBusHandlerResolver');
        $memoryBusHandlerResolverMock->expects($this->once())
            ->method('resolve')
            ->will($this->returnValue($queryHandlerMock));
        
        $queryMock = $this->getMock('ServiceBus\IQuery');
        
        $mediator = new Mediator($memoryBusHandlerResolverMock);
        
        $this->assertEquals($returned, $mediator->request($queryMock));
    }
    
    public function testValidSendQuery()
    {
        $commandHandlerMock = $this->getMock('ServiceBus\ICommandHandler', array('handle'));
        $commandHandlerMock->expects($this->once())
            ->method('handle');
    
        $memoryBusHandlerResolverMock = $this->getMock('ServiceBus\ServiceBusHandlerResolver');
        $memoryBusHandlerResolverMock->expects($this->once())
            ->method('resolve')
            ->will($this->returnValue($commandHandlerMock));
        
        $commandMock = $this->getMock('ServiceBus\ICommand');
        
        $mediator = new Mediator($memoryBusHandlerResolverMock);
        $mediator->send($commandMock);
    }

}