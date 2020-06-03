<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class EngineMock extends AbstractEngine
{
    private $min;

    private $max;

    private $n;

    public function __construct(int $min, int $max)
    {
        $this->n = $min;
        $this->min = $min;
        $this->max = $max;
    }

    public function min(): int
    {
        return $this->min;
    }

    public function max(): int
    {
        return $this->max;
    }

    public function next(): int
    {
        $n = $this->n;
        $this->n = $this->n === $this->max ? $this->min : $this->n + 1;
        return $n;
    }
}
