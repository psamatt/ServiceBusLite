<?php

namespace ServiceBus;

use ServiceBus\Exception\HandlerNotFoundException;

class ServiceBusHandlerResolver
{
    private $commandHandlers;
    private $queryHandlers;
    
    public function __construct()
    {
        $this->commandHandlers = $this->queryHandlers = array();
    }
    
    /**
     * Find the command handler. If the command handler has not been found, an exception is thrown
     *
     * @param object $query
     * @return object 
     */
    public function resolve($query)
    {
        $queryClassName = self::findBaseName($query);
    
        if ($query instanceof ICommand) {
            
            if (isset($this->commandHandlers[$queryClassName])) {
                return $this->commandHandlers[$queryClassName];
            }
            
            throw new HandlerNotFoundException($queryClassName);
        }
        
        // if its not a command, then it must be a query
        if (isset($this->queryHandlers[$queryClassName])) {
            return $this->queryHandlers[$queryClassName];
        }
        
        throw new HandlerNotFoundException($queryClassName);
    }
    
    /**
     * Add a command handler to the resolver
     *
     * @param ICommandHandler $commandHandler
     */
    public function addCommandHandler(ICommandHandler $commandHandler)
    {
        $commandClassName = preg_replace('/(.*)Handler$/i', '$1', self::findBaseName($commandHandler));
    
        $this->commandHandlers[$commandClassName] = $commandHandler;
    }
    
    /**
     * Add a query handler to the resolver
     *
     * @param IQueryHandler $queryHandler
     */
    public function addQueryHandler(IQueryHandler $queryHandler)
    {
        $queryClassName = preg_replace('/(.*)Handler$/i', '$1', self::findBaseName($queryHandler));
        
        $this->queryHandlers[$queryClassName] = $queryHandler;
    }
    
    /**
     * Find the base name of an object
     *
     * @param object
     * @return string
     */
    static function findBaseName($object)
    {
        $reflect = new \ReflectionClass($object);
        
        return $reflect->getShortName();
    }
}