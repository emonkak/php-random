<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @template T
 * @implements DistributionInterface<T>
 */
abstract class AbstractDistribution implements DistributionInterface
{
    /**
     * {@inheritdoc}
     */
    public function iterate(EngineInterface $engine): \Iterator
    {
        while (true) {
            yield $this->generate($engine);
        }
    }
}
