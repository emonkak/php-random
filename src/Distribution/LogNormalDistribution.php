<?php

declare(strict_types=1);

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\EngineInterface;

class LogNormalDistribution extends NormalDistribution
{
    /**
     * {@inheritdoc}
     */
    public function generate(EngineInterface $engine)
    {
        return exp(parent::generate($engine));
    }
}
