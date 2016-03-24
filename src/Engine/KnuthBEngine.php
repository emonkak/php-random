<?php

namespace Emonkak\Random\Engine;

class KnuthBEngine extends ShuffleOrderEngine
{
    public function __construct($seed = MinstdRandEngine::DEFAULT_SEED)
    {
        parent::__construct(new MinstdRand0Engine($seed), 256);
    }
}
