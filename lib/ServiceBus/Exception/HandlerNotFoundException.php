<?php

namespace ServiceBus\Exception;

/**
 * A Handler has not been found exception
 *
 */
final class HandlerNotFoundException extends \Exception
{
    public function __construct($specifiedHandler)
    {
        parent::__construct('The handler [' . $specifiedHandler . '] has not been found, are you sure you\'ve registered the handler?');
    }

}