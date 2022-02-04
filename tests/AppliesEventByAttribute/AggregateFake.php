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
    private function onQuantityChanged(DummyQuantityChanged $event): void
    {
        $this->quantity = $event->getQuantity();
    }

    #[EventSourcingHandler]
    private function onColorChanged($event): void
    {
    }

    #[EventSourcingHandler]
    private function onSizeChanged(DummySizeChanged $event, int $foo): void
    {
    }

    #[EventSourcingHandler]
    private function onProductChanged(): void
    {
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
