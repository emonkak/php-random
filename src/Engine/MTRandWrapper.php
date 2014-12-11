<?php
/**
 * This file is part of the Random.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Random\Engine;

class MTRandWrapper extends AbstractEngine
{
    public function __construct($seed = null)
    {
        if ($seed !== null) {
            mt_srand($seed);
        }
    }

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
