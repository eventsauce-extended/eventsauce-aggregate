<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate\Reconstruction;

use ReflectionObject;

trait ApplyAggregateEventsByAttribute
{
    private int $aggregateRootVersion = 0;

    protected function apply(object $event): void
    {
        $reflection = new ReflectionObject($this);

        foreach ($reflection->getMethods() as $method) {
            $attribute = $method->getAttributes(EventSourcingHandler::class)[0] ?? null;
            if (null === $attribute) {
                continue;
            }
            if (1 !== $method->getNumberOfRequiredParameters()) {
                throw EventSourcingHandlerArgumentException::eventHandlerRequireOneArgument($method->getShortName());
            }

            $parameter = $method->getParameters()[0];
            if (null === $type = $parameter->getType()) {
                throw EventSourcingHandlerArgumentException::noEventHandlerArgumentType($method->getShortName());
            }

            if ($event::class === $type->getName()) {
                $method->invoke($this, $event);
                break;
            }
        }

        ++$this->aggregateRootVersion;
    }
}
