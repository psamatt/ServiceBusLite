<?php

namespace ServiceBus;

interface ICommandHandler
{
    /**
     * Handle the Command
     *
     * @param ICommand $command
     */
    public function Handle(ICommand $command);
}