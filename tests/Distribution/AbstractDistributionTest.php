<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Distribution\AbstractDistribution;
use PHPUnit\Framework\TestCase;

class AbstractDistributionTest extends TestCase
{
    use DistributionTestTrait;

    public function testIterate(): void
    {
        $engine = $this->createIncrementalEngineMock(0, 9);

        $distribution = $this->getMockForAbstractClass(AbstractDistribution::class);
        $distribution
            ->expects($this->any())
            ->method('generate')
            ->with($this->identicalTo($engine))
            ->willReturn(1234);

        $iterator = $distribution->iterate($engine);

        $iterator->rewind();

        for ($i = 0; $i < 10; $i++) {
            $this->assertTrue($iterator->valid());
            $this->assertSame(1234, $iterator->current());
            $this->assertSame($i, $iterator->key());
            $iterator->next();
        }
    }
}
