<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

class RandomDevice extends AbstractEngine
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
        return 0x7fffffff;
    }

    /**
     * {@inheritdoc}
     */
    public function next(): int
    {
        $bytes = random_bytes(4);
        if (strlen($bytes) !== 4) {
            // @codeCoverageIgnoreStart
            throw new \RuntimeException('Unable to get random bytes.');
            // @codeCoverageIgnoreEnd
        }
        $array = unpack('Nint', $bytes);
        return $array['int'] & 0x7FFFFFFF;   // 32-bit mask
    }
}
