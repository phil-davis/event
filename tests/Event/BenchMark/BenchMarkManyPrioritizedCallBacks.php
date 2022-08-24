<?php

declare(strict_types=1);

namespace Sabre\Event\BenchMark;

use Sabre\Event\Emitter;

include __DIR__.'/../../../vendor/autoload.php';

class BenchMarkManyPrioritizedCallBacks extends BenchMark
{
    protected Emitter $emitter;

    public function setUp(): void
    {
        $this->emitter = new Emitter();
        for ($i = 0; $i < 100; ++$i) {
            $this->emitter->on('foo', function () {
            }, 1000 - $i);
        }
    }

    public function test(): void
    {
        for ($i = 0; $i < $this->iterations; ++$i) {
            $this->emitter->emit('foo', []);
        }
    }
}
