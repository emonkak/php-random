<?php

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

abstract class AbstractDistribution
{
    /**
     * @param AbstractEngine $engine
     * @return mixed
     */
    public function __invoke(AbstractEngine $engine)
    {
        return $this->generate($engine);
    }

    /**
     * @param AbstractEngine $engine
     * @return mixed
     */
    abstract public function generate(AbstractEngine $engine);

    /**
     * @param AbstractEngine $engine
     * @return \Iterator
     */
    public function iterate(AbstractEngine $engine)
    {
        return new DistributionIterator($this, $engine);
    }
}
