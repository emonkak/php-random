<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

/**
 * @extends AbstractDistribution<int>
 */
class DiscreteDistribution extends AbstractDistribution
{
    /**
     * @var float[]
     */
    private $probabilities;

    /**
     * @var UniformRealDistribution
     */
    private $uniform;

    /**
     * @param float[] $probabilities
     */
    public function __construct(array $probabilities)
    {
        assert(!empty($probabilities));

        $totalProbability = 0;

        foreach ($probabilities as $probability) {
            $totalProbability += $probability;
        }

        $this->probabilities = $probabilities;
        $this->uniform = new UniformRealDistribution(0, $totalProbability);
    }

    /**
     * @return float[]
     */
    public function getProbabilities(): array
    {
        return $this->probabilities;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(EngineInterface $engine)
    {
        $result = $this->uniform->generate($engine);
        $sum = 0;

        foreach ($this->probabilities as $index => $probability) {
            $sum += $probability;

            if ($probability > 0 && $result <= $sum) {
                return $index;
            }
        }

        // @codeCoverageIgnoreStart
        throw new \RuntimeException('Cannot generate the random number. Please confirm the probabilities.');
        // @codeCoverageIgnoreEnd
    }
}
