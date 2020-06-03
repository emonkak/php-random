<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

/**
 * Represents the broken Mersenne Twister implementation of old PHP (<7.2)
 *
 * https://www.php.net/manual/migration72.incompatible.php#migration72.incompatible.rand-mt_rand-output
 */
class PhpMT19937Engine extends MT19937Engine
{
    protected function twist(int $m, int $u, int $v): int
    {
        $y = ($u & 0x80000000) | ($v & 0x7fffffff);
        return $m ^ (($y >> 1) & 0x7fffffff) ^ -($u & 0x00000001) & 0x9908b0df;
    }
}
