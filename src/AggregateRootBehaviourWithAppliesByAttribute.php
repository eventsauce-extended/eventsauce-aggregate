<?php

declare(strict_types=1);

namespace Andreo\EventSauce\Aggregate;

use EventSauce\EventSourcing\AggregateRootBehaviour;

trait AggregateRootBehaviourWithAppliesByAttribute
{
    use AggregateRootBehaviour, AggregateAppliesEventByAttribute {
        AggregateAppliesEventByAttribute::apply insteadof AggregateRootBehaviour;
    }
}
