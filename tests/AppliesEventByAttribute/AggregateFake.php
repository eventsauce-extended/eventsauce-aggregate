<?php

declare(strict_types=1);


namespace Tests\AppliesEventByAttribute;

use Andreo\EventSauce\Aggregate\AggregateAppliesEventByAttribute;
use Andreo\EventSauce\Aggregate\EventSourcingHandler;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;


class AggregateFake implements AggregateRoot
{
    use AggregateRootBehaviour, AggregateAppliesEventByAttribute {
        AggregateAppliesEventByAttribute::apply insteadof AggregateRootBehaviour;
    }

    private int $incrementedNumber = 0;

    #[EventSourcingHandler]
    private function onAggregateNumberIncremented(AggregateNumberIncremented $event): void
    {
        $this->incrementedNumber = $event->getNumber();
    }

    public function getIncrementedNumber(): int
    {
        return $this->incrementedNumber;
    }
}