<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @template T
 */
interface DistributionInterface
{
    /**
     * @return T
     */
    public function generate(EngineInterface $engine);

    /**
     * @return \Iterator<T>
     */
    public function iterate(EngineInterface $engine): \Iterator;
}
