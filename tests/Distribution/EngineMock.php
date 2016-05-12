<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class EngineMock extends AbstractEngine
{
    private $min;

    private $max;

    private $n;

    public function __construct($min, $max)
    {
        $this->n = $min;
        $this->min = $min;
        $this->max = $max;
    }

    public function min()
    {
        return $this->min;
    }

    public function max()
    {
        return $this->max;
    }

    public function next()
    {
        $n = $this->n;
        $this->n = $this->n === $this->max ? $this->min : $this->n + 1;
        return $n;
    }
}
