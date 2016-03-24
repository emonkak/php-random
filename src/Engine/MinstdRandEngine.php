<?php

namespace Emonkak\Random\Engine;

class MinstdRandEngine extends LinearCongruentialEngine
{
    /**
     * @param integer $x The Seed number
     */
    public function __construct($x)
    {
        parent::__construct(48271, 0, 2147483647, $x);
    }
}
