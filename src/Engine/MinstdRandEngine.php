<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

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
