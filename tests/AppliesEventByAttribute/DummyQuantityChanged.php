<?php

declare(strict_types=1);

namespace Tests\AppliesEventByAttribute;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class DummyQuantityChanged implements SerializablePayload
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function toPayload(): array
    {
        return [
            'quantity' => $this->quantity,
        ];
    }

    public static function fromPayload(array $payload): self
    {
        return new self($payload['quantity']);
    }
}
