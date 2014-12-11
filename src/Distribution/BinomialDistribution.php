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

class BinomialDistribution extends AbstractDistribution
{
    /**
     * @var integer
     */
    private $n;

    /**
     * @var float
     */
    private $probability;

    /**
     * @param integer $t
     * @param float $p
     */
    public function __construct($t, $p)
    {
        assert(0 <= $t);
        assert(0 <= $p && $p <= 1);

        $this->t = $t;
        $this->p = $p;
    }

    /**
     * @return integer
     */
    public function getT()
    {
        return $this->t;
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
        $success = 0;

        for ($i = 0; $i < $this->t; ++$i) {
            if ($engine->nextDouble() <= $this->p) {
                $success++;
            }
        }

        return $success;
    }
}
