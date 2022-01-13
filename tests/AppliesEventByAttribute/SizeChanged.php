<?php

declare(strict_types=1);

namespace Tests\AppliesEventByAttribute;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class SizeChanged implements SerializablePayload
{
    private string $size;

    public function __construct(string $size)
    {
        $this->size = $size;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function toPayload(): array
    {
        return [
            'size' => $this->size,
        ];
    }

    public static function fromPayload(array $payload): self
    {
        return new self($payload['size']);
    }
}
