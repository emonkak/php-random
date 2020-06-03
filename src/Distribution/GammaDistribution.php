<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<float>
 */
class GammaDistribution extends AbstractDistribution
{
    /**
     * @var float
     */
    private $alpha;

    /**
     * @var float
     */
    private $beta;

    /**
     * @var ExponentialDistribution
     */
    private $exponential;

    /**
     * @var float
     */
    private $p;

    public function __construct(float $alpha, float $beta)
    {
        assert($alpha > 0.0);
        assert($beta > 0.0);

        $this->alpha = $alpha;
        $this->beta = $beta;
        $this->exponential = new ExponentialDistribution(1.0);
        $this->p = exp(1.0) / ($alpha + exp(1.0));
    }

    public function getAlpha(): float
    {
        return $this->alpha;
    }

    public function getBeta(): float
    {
        return $this->beta;
    }

    /**
     * {@inheritdoc}
     * @psalm-suppress InvalidNullableReturnType
     */
    public function generate(EngineInterface $engine)
    {
        if ($this->alpha == 1.0) {
            return $this->exponential->generate($engine) * $this->beta;
        } elseif ($this->alpha > 1.0) {
            while (true) {
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
            while (true) {
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
