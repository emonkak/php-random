<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

class ShuffleOrderEngine extends AbstractEngine
{
    /**
     * @var EngineInterface
     */
    private $engine;

    /**
     * @var int
     */
    private $k;

    /**
     * @var \SplFixedArray
     */
    private $v;

    /**
     * @var int
     */
    private $y;

    public function __construct(EngineInterface $engine, int $k)
    {
        $this->engine = $engine;
        $this->k = $k;
        $this->v = new \SplFixedArray($k);

        for ($i = 0; $i < $k; $i++) {
            $this->v[$i] = $this->engine->next();
        }

        $this->y = $this->engine->next();
    }

    /**
     * {@inheritdoc}
     */
    public function min(): int
    {
        return $this->engine->min();
    }

    /**
     * {@inheritdoc}
     */
    public function max(): int
    {
        return $this->engine->max();
    }

    /**
     * {@inheritdoc}
     */
    public function next(): int
    {
        $min = $this->engine->min();
        $max = $this->engine->max();

        $i = (int) ($this->k * ($this->y - $min) / ($max - $min + 1));

        $this->y = $this->v[$i];
        $this->v[$i] = $this->engine->next();

        return $this->y;
    }
}
