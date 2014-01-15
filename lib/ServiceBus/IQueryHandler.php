<?php

namespace ServiceBus;

interface IQueryHandler
{
    /**
     * Handle the query
     *
     * @param IQuery $query
     */
    public function Handle(IQuery $query);
}