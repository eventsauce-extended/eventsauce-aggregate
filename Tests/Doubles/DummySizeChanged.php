<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate\Tests\Doubles;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class DummySizeChanged implements SerializablePayload
{
    public function toPayload(): array
    {
        return [];
    }

    public static function fromPayload(array $payload): static
    {
        return new self();
    }
}
