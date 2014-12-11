<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class BernoulliDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $p;

    /**
     * @param float $p
     */
    public function __construct($p)
    {
        assert(0 <= $p && $p <= 1);

        $this->p = $p;
    }

    /**
     * @return float
     */
    public function getP()
    {
        return $this->p;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        return $engine->nextDouble() <= $this->p;
    }
}
