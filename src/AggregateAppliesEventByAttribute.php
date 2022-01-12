<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate;

use InvalidArgumentException;
use ReflectionObject;

trait AggregateAppliesEventByAttribute
{
    private int $aggregateRootVersion = 0;

    protected function apply(object $event): void
    {
        $reflection = new ReflectionObject($this);

        foreach ($reflection->getMethods() as $method) {
            $attributes = $method->getAttributes(EventSourcingHandler::class)[0] ?? null;
            if (null === $attributes) {
                continue;
            }
            if (1 !== $method->getNumberOfRequiredParameters()) {
                throw new InvalidArgumentException('Event sourcing handler method requires an one argument.');
            }

            $parameter = $method->getParameters()[0];
            if (null === $parameter->getType()) {
                throw new InvalidArgumentException('Event sourcing handler method requires an argument with event type.');
            }

            if ($event::class === $parameter->getType()->getName()) {
                $this->{$method->getName()}($event);
                ++$this->aggregateRootVersion;
                
                break;
            }
        }
    }
}
