<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate;

use Andreo\EventSauce\Aggregate\Exception\InvalidArgumentException;
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
                throw InvalidArgumentException::eventHandlerOneArgument();
            }

            $parameter = $method->getParameters()[0];
            if (null === $type = $parameter->getType()) {
                throw InvalidArgumentException::eventHandlerTypeArgument();
            }

            if ($event::class === $type->getName()) {
                $method->invoke($this, $event);
                ++$this->aggregateRootVersion;

                break;
            }
        }
    }
}
