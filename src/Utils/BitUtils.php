<?php

namespace Emonkak\Random\Utils;

class BitUtils
{
    /**
     * @codeCoverageIgnore
     */
    private function __construct()
    {
    }

    /**
     * Do logical right shift
     *
     * @param integer $x
     * @param integer $y
     * @return integer
     */
    public static function shiftR($x, $n)
    {
        return $x >> $n & ~(~0 << (32 - $n));
    }

    /**
     * @param integer $x
     * @param integer $y
     * @return integer
     */
    public static function multiply($x, $y)
    {
        $result = 0;

        while ($y != 0) {
            if ($y & 1) {
                $result += $x;
            }

            $x = $x << 1;
            $y = self::shiftR($y, 1);
        }

        return $result;
    }

    /**
     * @param integer $m
     * @param integer $u
     * @param integer $v
     * @return integer
     */
    public static function twist($m, $u, $v)
    {
        return ($m ^ self::shiftR(($u & 0x80000000) | ($v & 0x7FFFFFFF), 1)
                   ^ -($u & 0x00000001) & 0x9908B0DF);
    }
}
