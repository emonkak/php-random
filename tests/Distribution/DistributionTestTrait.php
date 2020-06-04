<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Engine\EngineInterface;

trait DistributionTestTrait
{
    public function createNullEngineMock(): EngineInterface
    {
        $engine = $this->createMock(EngineInterface::class);
        $engine
            ->expects($this->never())
            ->method($this->anything());
        return $engine;
    }

    public function createIncrementalEngineMock($min, $max): EngineInterface
    {
        return new EngineMock($min, $max);
    }

    public function createFixedEngineMock($min, $max, $n): EngineInterface
    {
        $engine = $this->createMock(EngineInterface::class);
        $engine
            ->expects($this->any())
            ->method('min')
            ->willReturn($min);
        $engine
            ->expects($this->any())
            ->method('max')
            ->willReturn($max);
        $engine
            ->expects($this->any())
            ->method('next')
            ->willReturn($n);
        return $engine;
    }
}
