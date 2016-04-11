<?php

namespace Emonkak\Random\Tests\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class EngineMock extends AbstractEngine
{
    private $min;

    private $max;

    public function __construct($min, $max)
    {
        $this->i = $min;
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
        return $this->i = $this->i === $this->max ? $this->min : $this->i + 1;
    }
}
