<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Distribution;

use Random\Engine\AbstractEngine;

class GeometricDistribution extends AbstractDistribution
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
        assert(0 < $p && $p < 1);

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
        $result = log(1 - $engine->nextFloat()) / log(1 - $this->p);

        return (int) $result;
    }
}
