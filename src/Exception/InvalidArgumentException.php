<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;

final class InvalidArgumentException extends BaseInvalidArgumentException
{
    public static function eventHandlerOneArgument(string $method): self
    {
        return new self(sprintf('Event sourcing handler method "%s" requires an one argument.', $method));
    }

    public static function eventHandlerTypeArgument(string $method): self
    {
        return new self(sprintf('Event sourcing handler method "%s" requires an argument with event type.', $method));
    }
}
