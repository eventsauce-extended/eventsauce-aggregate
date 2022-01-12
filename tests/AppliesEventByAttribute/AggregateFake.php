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

    private int $quantity = 0;

    private string $color;

    private string $size;

    #[EventSourcingHandler]
    private function onAggregateNumberIncremented(QuantityChanged $event): void
    {
        $this->quantity = $event->getQuantity();
    }

    #[EventSourcingHandler]
    private function onColorChanged($event): void
    {
        assert($event instanceof ColorChanged);

        $this->color = $event->getColor();
    }

    #[EventSourcingHandler]
    private function onSizeChanged(SizeChanged $event, int $foo): void
    {
        $this->size = $event->getSize();
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}