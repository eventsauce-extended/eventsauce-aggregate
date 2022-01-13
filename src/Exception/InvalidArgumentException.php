<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;

final class InvalidArgumentException extends BaseInvalidArgumentException
{
    public static function eventHandlerOneArgument(): self
    {
        return new self('Event sourcing handler method requires an one argument.');
    }

    public static function eventHandlerTypeArgument(): self
    {
        return new self('Event sourcing handler method requires an argument with event type.');
    }
}
