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

class GammaDistribution extends AbstractDistribution
{
    /**
     * @param float
     */
    private $alpha;

    /**
     * @param float
     */
    private $beta;

    /**
     * @param float
     */
    private $p;

    /**
     * @param float $alpha
     * @param float $beta
     */
    public function __construct($alpha, $beta)
    {
        assert($alpha > 0.0);
        assert($beta > 0.0);

        $this->alpha = $alpha;
        $this->beta = $beta;
        $this->exponential = new ExponentialDistribution(1.0);
        $this->p = exp(1.0) / ($alpha + exp(1.0));
    }

    /**
     * @return float
     */
    public function getAlpha()
    {
        return $this->alpha;
    }

    /**
     * @return float
     */
    public function getBeta()
    {
        return $this->beta;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        if ($this->alpha == 1.0) {
            return $this->exponential->generate($engine) * $this->beta;
        } elseif ($this->alpha > 1.0) {
            for (;;) {
                $y = tan(M_PI * $engine->nextDouble());
                $x = sqrt(2.0 * $this->alpha - 1.0) * $y + $this->alpha - 1.0;

                if ($x <= 0.0) {
                    continue;
                }

                if ($engine->nextDouble()
                    > (1.0 + $y * $y)
                      * exp(($this->alpha - 1.0)
                            * log($x / ($this->alpha - 1.0))
                            - sqrt(2.0 * $this->alpha - 1.0) * $y)) {
                    continue;
                }

                return $x * $this->beta;
            }
        } else {  // $this->alpha < 1.0
            for (;;) {
                $u = $engine->nextDouble();
                $y = $this->exponential->generate($engine);

                if ($u < $this->p) {
                    $x = exp(-$y / $this->alpha);
                    $q = $this->p * exp(-$x);
                } else {
                    $x = 1.0 + $y;
                    $q = $this->p + (1.0 - $this->p) * pow($x, $this->alpha - 1.0);
                }

                if ($u >= $q) {
                    continue;
                }

                return $x * $this->beta;
            }
        }
    }
}
