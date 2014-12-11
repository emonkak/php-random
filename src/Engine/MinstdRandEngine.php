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
     * @param integer $s
     */
    public function __construct($s = self::DEFAULT_SEED)
    {
        parent::__construct(48271, 0, 2147483647, $s);
    }
}
