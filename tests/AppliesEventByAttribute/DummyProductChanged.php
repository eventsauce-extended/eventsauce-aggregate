<?php

declare(strict_types=1);

namespace Tests\AppliesEventByAttribute;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class DummyProductChanged implements SerializablePayload
{
    public function toPayload(): array
    {
        return [
        ];
    }

    public static function fromPayload(array $payload): static
    {
        return new self();
    }
}
