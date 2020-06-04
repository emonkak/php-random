<?php

declare(strict_types=1);

namespace Emonkak\Random\Tests\Engine;

use Emonkak\Random\Engine\KnuthBEngine;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Emonkak\Random\Engine\KnuthBEngine
 */
class KnuthBEngineTest extends TestCase
{
    public function testNext(): void
    {
        $engine = new KnuthBEngine();
        $engine->discard(9999);
        $this->assertSame(1112339016, $engine->next());
    }
}
