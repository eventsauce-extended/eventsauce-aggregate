<?php

declare(strict_types=1);


namespace Tests\AppliesEventByAttribute;

use EventSauce\EventSourcing\AggregateRootId;
use EventSauce\EventSourcing\TestUtilities\AggregateRootTestCase;

final class AggregateAppliesEventByAttributeTest extends AggregateRootTestCase
{
    /**
     * @test
     */
    public function event_applied(): void
    {
        $this->given(
            new AggregateNumberIncremented(1),
            new AggregateNumberIncremented(2),
            new AggregateNumberIncremented(3),
        );

        /** @var AggregateFake $aggregate */
        $aggregate = $this->repository->retrieve($this->aggregateRootId);
        $this->assertInstanceOf(AggregateFake::class, $aggregate);
        $this->assertEquals(3, $aggregate->getIncrementedNumber());
    }

    protected function newAggregateRootId(): AggregateRootId
    {
        return DummyAggregateId::create();
    }

    protected function aggregateRootClassName(): string
    {
        return AggregateFake::class;
    }
}