<?php

namespace Emonkak\Random\Engine;

class RandomDevice extends AbstractEngine
{
    /**
     * {@inheritDoc}
     */
    public function max()
    {
        return 0x7fffffff;
    }

    /**
     * {@inheritDoc}
     */
    public function min()
    {
        return 0;
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        $bytes = function_exists('random_bytes') ? random_bytes(4) : mcrypt_create_iv(4, MCRYPT_DEV_URANDOM);
        if ($bytes === false || strlen($bytes) !== 4) {
            throw new RuntimeException('Unable to get 4 bytes');
        }
        $array = unpack('Nint', $bytes);
        return $array['int'] & 0x7FFFFFFF;   // 32-bit safe
    }
}
