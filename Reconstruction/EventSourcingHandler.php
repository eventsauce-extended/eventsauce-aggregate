<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate\Reconstruction;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
final readonly class EventSourcingHandler
{
}
