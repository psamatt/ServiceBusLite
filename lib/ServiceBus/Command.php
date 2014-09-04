<?php

namespace ServiceBus;

use ServiceBus\ICommand;

abstract class Command implements ICommand
{
	public function __construct(array $args = array())
	{
		foreach ($args as $property => $value) {
            $this->$property = $value;
        }
	}
}