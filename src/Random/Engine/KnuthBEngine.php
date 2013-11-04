<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Random\Engine;

class KnuthBEngine extends ShuffleOrderEngine
{
    public function __construct($seed = MinstdRandEngine::DEFAULT_SEED)
    {
        parent::__construct(new MinstdRand0Engine($seed), 256);
    }
}
