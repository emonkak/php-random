<?php

namespace Random;

class MersenneTwisterNative extends AbstractRandom
{
    public function __destruct()
    {
        mt_srand();
    }

    public function initialize($seed)
    {
        mt_srand($seed);
    }

    public function maximum()
    {
        return mt_getrandmax();
    }

    public function generate()
    {
        return mt_rand();
    }

    public function range($min, $max)
    {
        return mt_rand($min, $max);
    }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4
