<?php

namespace Emonkak\Random\Engine;

class MTRandWrapper extends AbstractEngine
{
    /**
     * {@inheritdoc}
     */
    public function max()
    {
        return mt_getrandmax();
    }

    /**
     * {@inheritdoc}
     */
    public function min()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return mt_rand();
    }
}
