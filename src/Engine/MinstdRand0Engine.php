<?php

namespace Emonkak\Random\Engine;

class MinstdRand0Engine extends LinearCongruentialEngine
{
    /**
     * @param integer $x The seed number
     */
    public function __construct($x)
    {
        parent::__construct(16807, 0, 2147483647, $x);
    }
}
