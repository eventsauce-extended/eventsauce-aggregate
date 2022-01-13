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
    public function event_applied(): void
    {
        $this->given(
            new QuantityChanged(1),
            new QuantityChanged(2),
            new QuantityChanged(3),
        );

        /** @var AggregateFake $aggregate */
        $aggregate = $this->repository->retrieve($this->aggregateRootId);
        $this->assertInstanceOf(AggregateFake::class, $aggregate);
        $this->assertEquals(3, $aggregate->getQuantity());
    }

    /**
     * @test
     */
    public function untyped_argument_throws_an_error(): void
    {
        $this->given(
            new ColorChanged('red'),
        );

        $this->expectException(UnableToReconstituteAggregateRoot::class);

        /* @var AggregateFake $aggregate */
        $this->repository->retrieve($this->aggregateRootId);
    }

    /**
     * @test
     */
    public function many_argument_throws_an_error(): void
    {
        $this->given(
            new SizeChanged('red'),
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
