<?php

namespace Random;

class XorShift extends AbstractRandom
{
    private $x = 123456789;
    private $y = 362436069;
    private $z = 521288629;
    private $w = 88675123;

    public function initialize($seed)
    {
        $this->x ^= $seed                         & 0xffffffff;
        $this->y ^= ($seed << 8)  | ($seed >> 24) & 0xffffffff;
        $this->z ^= ($seed << 16) | ($seed >> 16) & 0xffffffff;
        $this->w ^= ($seed << 24) | ($seed >> 8)  & 0xffffffff;
    }

    public function maximum()
    {
        return 0xffffffff;
    }

    public function generate()
    {
        $t = ($this->x ^ ($this->x << 11)) & 0xffffffff;
        $this->x = $this->y;
        $this->y = $this->z;
        $this->z = $this->w;
        $this->w = ($this->w ^ ($this->w >> 19) ^ ($t ^ ($t >> 8))) & 0xffffffff;
        return $this->w;
    }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4
