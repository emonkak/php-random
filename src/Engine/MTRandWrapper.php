<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

class MTRandWrapper extends AbstractEngine
{
    /**
     * {@inheritdoc}
     */
    public function min(): int
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function max(): int
    {
        return mt_getrandmax();
    }

    /**
     * {@inheritdoc}
     */
    public function next(): int
    {
        return mt_rand();
    }
}
