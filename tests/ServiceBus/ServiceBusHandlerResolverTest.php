<?php

namespace ServiceBus\Tests;

use ServiceBus\ServiceBusHandlerResolver;

class ServiceBusHandlerResolverTest extends \PHPUnit_Framework_TestCase
{
    public function testResolveValidCommandFindsValidCommandHandler()
    {
        $handlerResolver = $this->getHandlerResolver();
        
        $barCommand = $this->getMock('ServiceBus\ICommand', array(), array(), 'BarCommand');
        
        $barCommandHandler = $handlerResolver->resolve($barCommand);
        
        $this->assertInstanceOf('ServiceBus\ICommandHandler', $barCommandHandler);
    }
    
    /**
     * @expectedException \ServiceBus\Exception\HandlerNotFoundException
     */
    public function testResolveValidCommandFindsInvalidCommandHandler()
    {
        $handlerResolver = $this->getHandlerResolver();
        
        $notRegisteredCommand = $this->getMock('ServiceBus\ICommand', array(), array(), 'NotRegisteredCommand');
        
        $handlerResolver->resolve($notRegisteredCommand);
    }
    
    /**
     * @expectedException \ServiceBus\Exception\HandlerNotFoundException
     */
    public function testResolveValidQueryDoesNotFindSameNameCommand()
    {
        $handlerResolver = $this->getHandlerResolver(true, false);
        
        $barQuery = $this->getMock('ServiceBus\IQuery', array(), array(), 'BarQuery');
        
        $handlerResolver->resolve($barQuery);
    }
    
    public function testResolveValidQueryFindsValidQueryHandler()
    {
        $handlerResolver = $this->getHandlerResolver();
        
        $barQuery = $this->getMock('ServiceBus\IQuery', array(), array(), 'BarQuery');
        
        $barQueryHandler = $handlerResolver->resolve($barQuery);
        
        $this->assertInstanceOf('ServiceBus\IQueryHandler', $barQueryHandler);
    }
    
    /**
     * @expectedException \ServiceBus\Exception\HandlerNotFoundException
     */
    public function testResolveValidQueryFindsInvalidQueryHandler()
    {
        $handlerResolver = $this->getHandlerResolver();
        
        $notRegisteredQuery = $this->getMock('ServiceBus\IQuery', array(), array(), 'NotRegisteredQuery');
        
        $handlerResolver->resolve($notRegisteredQuery);
    }
    
    /**
     * Get handler resolver with mocked command and query handlers
     *
     * @param boolean
     */
    public function getHandlerResolver($addCommandHandlers = true, $addQueryHandlers = true)
    {        
        $handlerResolver = new ServiceBusHandlerResolver;

        if (true === $addCommandHandlers) {
            $handlerResolver->addCommandHandler($this->getMock('ServiceBus\ICommandHandler', array(), array(), 'FooCommandHandler'));
            $handlerResolver->addCommandHandler($this->getMock('ServiceBus\ICommandHandler', array(), array(), 'BarCommandHandler'));
        }
        
        if (true === $addQueryHandlers) {
            $handlerResolver->addQueryHandler($this->getMock('ServiceBus\IQueryHandler', array(), array(), 'FooQueryHandler'));
            $handlerResolver->addQueryHandler($this->getMock('ServiceBus\IQueryHandler', array(), array(), 'BarQueryHandler'));
        }
        
        return $handlerResolver;
    }
}