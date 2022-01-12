<?php

declare(strict_types=1);


namespace Andreo\EventSauce\Aggregate;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
final class EventSourcingHandler
{
}