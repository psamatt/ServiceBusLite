<?php

namespace ServiceBus;

class Mediator implements IMediator
{
    private $handlerResolver;

    /**
     * Constructor
     */
    public function __construct(ServiceBusHandlerResolver $handlerResolver)
    {
        $this->handlerResolver = $handlerResolver;
    }
    
    /* {inheritdoc} */
    public function request(IQuery $query)
    {
        $handler = $this->handlerResolver->resolve($query);
        
        return $handler->handle($query);
    }

    /** {inheritdoc} */
    public function send(ICommand $command)
    {
        $handler = $this->handlerResolver->resolve($command);
        
        $handler->handle($command);
    }
}