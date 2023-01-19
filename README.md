## eventsauce-aggregate 3.0

Extended aggregate components for EventSauce

### Installation

```bash
composer require andreo/eventsauce-aggregate
```
#### Handle aggregate event based on an attribute

```php
use EventSauce\EventSourcing\AggregateRoot;
use Andreo\EventSauce\Aggregate\Reconstruction\EventSourcingHandler;
use Andreo\EventSauce\Aggregate\Reconstruction\AggregateRootBehaviourWithAppliesEventsByAttribute;

final class FooAggregate implements AggregateRoot
{
    use AggregateRootBehaviourWithAppliesEventsByAttribute;
    
    #[EventSourcingHandler]
    public function onFooInitiated(FooInitiated $event): void
    {
    }
}
```