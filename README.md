# eventsauce-aggregate

Extended aggregate components of the EventSauce


### Apply event by attribute

By default, EventSauce aggregate events based on 
apply{EventClassName} [convention](https://eventsauce.io/docs/event-sourcing/create-an-aggregate-root/).
This library enables event application based on
a dedicated attribute, not based on the method name.

#### Usage

```php

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;
use Andreo\EventSauce\Aggregate\AggregateAppliesEventByAttribute;
use Andreo\EventSauce\Aggregate\EventSourcingHandler;

final class SomeAggregate implements AggregateRoot
{
    use AggregateRootBehaviour, AggregateAppliesEventByAttribute {
        AggregateAppliesEventByAttribute::apply insteadof AggregateRootBehaviour;
    }
    
    #[EventSourcingHandler]
    public function onInitiated(ProcessWasInitiated $event): void
    {
    }
}
```