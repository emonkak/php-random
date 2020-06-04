<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

class LinearCongruentialEngine extends AbstractEngine
{
    const DEFAULT_SEED = 1;

    /**
     * @var int
     */
    private $a;

    /**
     * @var int
     */
    private $c;

    /**
     * @var int
     */
    private $m;

    /**
     * @var int
     */
    private $x;

    public function __construct(int $a, int $c, int $m, int $x)
    {
        $this->a = $a;
        $this->c = $c;
        $this->m = $m;
        $this->x = $x;
    }

    /**
     * {@inheritdoc}
     */
    public function min(): int
    {
        return $this->c == 0 ? 1 : 0;
    }

    /**
     * {@inheritdoc}
     */
    public function max(): int
    {
        return $this->m - 1;
    }

    /**
     * {@inheritdoc}
     */
    public function next(): int
    {
        return $this->x = (int) fmod($this->a * $this->x + $this->c, $this->m);
    }
}
