<?php

namespace ServiceBus;

interface IMediator
{
    /**
     * Request some information
     *
     * @param IQuery
     */
    public function Request(IQuery $query);
    
    /**
     * Send a command into a deep hole expecting no return 
     *
     * @param ICommand
     */
    public function Send(ICommand $query);
}