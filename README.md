## eventsauce-aggregate

Extended aggregate components for EventSauce


### Installation

```bash
composer require andreo/eventsauce-aggregate
```
### Requirements

- PHP ^8.1

### Apply event by attribute

By default, EventSauce aggregate events based on method name
[convention](https://eventsauce.io/docs/event-sourcing/create-an-aggregate-root/)
apply{EventClassName}.
This library provides apply event based on
a dedicated attribute, not based on the method name.

#### Usage

```php
use EventSauce\EventSourcing\AggregateRoot;
use Andreo\EventSauce\Aggregate\EventSourcingHandler;
use Andreo\EventSauce\Aggregate\AggregateRootBehaviourWithAppliesByAttribute;

final class SomeAggregate implements AggregateRoot
{
    use AggregateRootBehaviourWithAppliesByAttribute;
    
    #[EventSourcingHandler]
    public function onInitiated(ProcessWasInitiated $event): void
    {
    }
}
```