<?php

declare(strict_types=1);

namespace Emonkak\Random\Engine;

/**
 * @implements \IteratorAggregate<int>
 */
interface EngineInterface extends \IteratorAggregate
{
    /**
     * Advances the internal state by z notches.
     */
    public function discard(int $z): void;

    /**
     * Returns the minimum number that will be generated.
     */
    public function min(): int;

    /**
     * Returns the maximum number that will be generated.
     */
    public function max(): int;

    /**
     * Returns a next random number.
     */
    public function next(): int;

    /**
     * Returns a next random number that is greater than or equal to 0 and less than 1.
     */
    public function nextDouble(): float;
}
