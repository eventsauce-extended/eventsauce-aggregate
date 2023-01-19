<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate\Reconstruction;

use InvalidArgumentException;

final class EventSourcingHandlerArgumentException extends InvalidArgumentException
{
    public static function eventHandlerRequireOneArgument(string $method): self
    {
        return new self(sprintf('Event sourcing handler "%s" require an one argument of event.', $method));
    }

    public static function noEventHandlerArgumentType(string $method): self
    {
        return new self(sprintf('Event sourcing handler "%s" requires a typed argument of event.', $method));
    }
}
