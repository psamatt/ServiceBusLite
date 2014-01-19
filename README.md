# Service Bus Lite 

Service Bus Lite is a PHP implementation of the popular NServiceBus in C#, you can find more information about a Service Bus on [Wikipedia](http://en.wikipedia.org/wiki/Enterprise_service_bus). This has been written with the influence of the popular [ShortBus](https://github.com/mhinze/ShortBus) library in C#.

## Introduction

The idea of a service bus in a MVC Architecture is essentially a messaging queue that sits between the application logic (Controller) and your business logic (Domain). Upon firing requests at the message bus in the form of a Query or a Command, a matching Handler will be found and executed. 

Your Handler will do your logic dependant on the type of request:

* Query - A query is your read layer and will request information such as fetching all users who are from a specific country. This should be a layer that talks to your persistance or cache layer and should NEVER do write actions.

* Command - A command is your write layer and will send information to your application such as creating records in your persistance layer, writing to logs etc.

### How do I get started? 

Using [Composer](http://getcomposer.org/doc/00-intro.md), add the following into your composer.json

```json
{
    "require": {
        psamatt/service-bus-lite": "dev-master"
    }
}

```

Now tell composer to download the bundle by running the following command:

`$ php composer.phar update psamatt/service-bus-lite`

### Examples

To find how to use this library, check the [examples](https://github.com/psamatt/ServiceBusLite/tree/master/example).

### Integrated into...

This library has been integrated into the following PHP Frameworks:

- Symfony2 using [ServiceBusLiteBundle](https://github.com/psamatt/ServiceBusLiteBundle)

If you have integrated this into an unlisted Framework, then get in touch.
