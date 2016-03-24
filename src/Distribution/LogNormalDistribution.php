<?php

namespace Emonkak\Random\Distribution;

use Emonkak\Random\Engine\AbstractEngine;

class LogNormalDistribution extends NormalDistribution
{
    /**
     * {@inheritdoc}
     */
    public function generate(AbstractEngine $engine)
    {
        return exp(parent::generate($engine));
    }
}
