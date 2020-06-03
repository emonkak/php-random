<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

class MinstdRand0Engine extends LinearCongruentialEngine
{
    public function __construct(int $x)
    {
        parent::__construct(16807, 0, 2147483647, $x);
    }
}
