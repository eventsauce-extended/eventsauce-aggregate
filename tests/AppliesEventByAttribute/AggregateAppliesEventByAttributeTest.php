<?php

declare(strict_types=1);

namespace Tests\AppliesEventByAttribute;

use EventSauce\EventSourcing\AggregateRootId;
use EventSauce\EventSourcing\TestUtilities\AggregateRootTestCase;
use EventSauce\EventSourcing\UnableToReconstituteAggregateRoot;

final class AggregateAppliesEventByAttributeTest extends AggregateRootTestCase
{
    /**
     * @test
     */
    public function should_applied_given_events(): void
    {
        $this->given(
            new DummyQuantityChanged(1),
            new DummyQuantityChanged(2),
            new DummyQuantityChanged(3),
        );

        /** @var AggregateFake $aggregate */
        $aggregate = $this->repository->retrieve($this->aggregateRootId);
        $this->assertInstanceOf(AggregateFake::class, $aggregate);
        $this->assertEquals(3, $aggregate->getQuantity());
    }

    /**
     * @test
     */
    public function should_throw_exception_if_event_handler_argument_has_not_type(): void
    {
        $this->given(
            new DummyColorChanged(),
        );

        $this->expectException(UnableToReconstituteAggregateRoot::class);

        /* @var AggregateFake $aggregate */
        $this->repository->retrieve($this->aggregateRootId);
    }

    /**
     * @test
     */
    public function should_throw_exception_if_event_handler_has_many_argument(): void
    {
        $this->given(
            new DummySizeChanged(),
        );

        $this->expectException(UnableToReconstituteAggregateRoot::class);

        /* @var AggregateFake $aggregate */
        $this->repository->retrieve($this->aggregateRootId);
    }

    /**
     * @test
     */
    public function should_throw_exception_if_event_handler_not_has_argument(): void
    {
        $this->given(
            new DummyProductChanged(),
        );

        $this->expectException(UnableToReconstituteAggregateRoot::class);

        /* @var AggregateFake $aggregate */
        $this->repository->retrieve($this->aggregateRootId);
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
