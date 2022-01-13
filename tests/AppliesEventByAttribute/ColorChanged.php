<?php

declare(strict_types=1);

namespace Tests\AppliesEventByAttribute;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class ColorChanged implements SerializablePayload
{
    private string $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function toPayload(): array
    {
        return [
            'color' => $this->color,
        ];
    }

    public static function fromPayload(array $payload): self
    {
        return new self($payload['color']);
    }
}
