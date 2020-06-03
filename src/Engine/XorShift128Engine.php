<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

class XorShift128Engine extends AbstractEngine
{
    const X = 123456789;
    const Y = 362436069;
    const Z = 521288629;
    const W = 88675123;

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var int
     */
    private $z;

    /**
     * @var int
     */
    private $w;

    public static function from(int $seed): self
    {
        // https://gist.github.com/gintenlabo/604721
        return new XorShift128Engine(
            self::X ^ $seed & 0xffffffff,
            self::Y ^ ($seed << 17) | (($seed >> 15) & 0x7fffffff) & 0xffffffff,
            self::Z ^ ($seed << 31) | (($seed >> 1) & 0x7fffffff) & 0xffffffff,
            self::W ^ ($seed << 18) | (($seed >> 14) & 0x7fffffff) & 0xffffffff
        );
    }

    public function __construct(int $x, int $y, int $z, int $w)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->w = $w;
    }

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
        return 0x7fffffff;
    }

    /**
     * {@inheritdoc}
     */
    public function next(): int
    {
        $t = ($this->x ^ ($this->x << 11)) & 0xffffffff;

        $this->x = $this->y;
        $this->y = $this->z;
        $this->z = $this->w;
        $this->w = ($this->w ^ (($this->w >> 19) & 0x7fffffff)
                             ^ ($t ^ (($t >> 8) & 0x7fffffff))) & 0xffffffff;

        // Kill the sign bit for 32bit systems.
        return $this->w & 0x7fffffff;
    }
}
