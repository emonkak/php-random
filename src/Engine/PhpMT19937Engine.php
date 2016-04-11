<?php

namespace Emonkak\Random\Engine;

/**
 * Represents Mersenne Twister algorithm that is consistently broken implementation in PHP 5.2.1+.
 *
 * https://github.com/php/php-src/commit/a0724d30817600540946b41e40f4cfc2a0c30f80
 */
class PhpMT19937Engine extends MT19937Engine
{
    /**
     * @param integer $m
     * @param integer $u
     * @param integer $v
     * @return integer
     */
    protected function twist($m, $u, $v)
    {
        $y = ($u & 0x80000000) | ($v & 0x7fffffff);
        return $m ^ (($y >> 1) & 0x7fffffff) ^ -($u & 0x00000001) & 0x9908b0df;
    }
}
