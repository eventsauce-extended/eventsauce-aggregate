<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate\Reconstruction;

use EventSauce\EventSourcing\AggregateRootBehaviour;

trait AggregateRootBehaviourWithAppliesEventsByAttribute
{
    use AggregateRootBehaviour, ApplyAggregateEventsByAttribute {
        ApplyAggregateEventsByAttribute::apply insteadof AggregateRootBehaviour;
    }
}
