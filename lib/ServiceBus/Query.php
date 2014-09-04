<?php

namespace ServiceBus;

use ServiceBus\IQuery;

abstract class Query implements IQuery
{
	public function __construct(array $args = array())
	{
		foreach ($args as $property => $value) {
            $this->$property = $value;
        }
	}
}