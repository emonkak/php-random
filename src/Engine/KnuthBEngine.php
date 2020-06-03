<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

class KnuthBEngine extends ShuffleOrderEngine
{
    public function __construct(int $seed = MinstdRand0Engine::DEFAULT_SEED)
    {
        parent::__construct(new MinstdRand0Engine($seed), 256);
    }
}
