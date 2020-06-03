<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

class MinstdRandEngine extends LinearCongruentialEngine
{
    public function __construct(int $x)
    {
        parent::__construct(48271, 0, 2147483647, $x);
    }
}
