<?php

/**
 * This example shows registering a command handler to register 
 * a user to an event, also registering a show events query that
 * returns back all the events that match a specific event name.
 * 
 * These are fired through the Mediator class using their 
 * matching Command / Query containing the properties 
 * associated with that action
 */

namespace MyApp;

require_once __DIR__ . '/../vendor/autoload.php';

/** Important:: class name must end in Handler and have an associated FooCommand */
class RegisterUserEventCommandHandler implements \ServiceBus\ICommandHandler
{
    private $eventRepository;

    public function __construct($eventRepository = null /* Default as null for illustration*/)
    {
        $this->eventRepository = $eventRepository;
    }

    public function Handle(\ServiceBus\ICommand $command)
    {
        /** 
         * Do some command related logic
         * update / add record into persistence layer
         * 
         * e.g $event = $this->eventRepository->find($command->eventId);
         * $event->registerUser($command->userId);
         */
    }
}

class RegisterUserEventCommand extends \ServiceBus\Command
{
    public $userId;
    public $eventId;
}

/** Important:: class name must end in Handler and have an associated ShowEventsQuery */
class ShowEventsQueryHandler implements \ServiceBus\IQueryHandler
{
    private $eventRepository;

    public function __construct($eventRepository = null /* Default as null for illustration*/)
    {
        $this->eventRepository = $eventRepository;
    }

    public function Handle(\ServiceBus\IQuery $query)
    {
        /**
         * Do some query related logic and return the results to be
         * used in the presentation logic
         *
         * i.e $eventItems = $this->eventRepository->findAllByTitle($query->eventName);
         */
        return $eventItems = [];
    }
}

class ShowEventsQuery extends \ServiceBus\Query
{
    public $eventName;
}

$serviceBusHandlerResolver = new \ServiceBus\ServiceBusHandlerResolver;
$serviceBusHandlerResolver->addCommandHandler(new RegisterUserEventCommandHandler);
$serviceBusHandlerResolver->addQueryHandler(new ShowEventsQueryHandler);

$mediator = new \ServiceBus\Mediator($serviceBusHandlerResolver);

/**
 * Query Example
 */
$showEventsQuery = new ShowEventsQuery(array('eventName' => 'PHP Conference UK'));
$eventItems = $mediator->request($showEventsQuery);

/**
 * Command Example
 */
$registerUserOntoEventCommand = new RegisterUserEventCommand(['userId' => 1, 'eventId' => 8]);
$mediator->send($registerUserOntoEventCommand);