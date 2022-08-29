<?php

declare(strict_types=1);

namespace Sabre\Event\BenchMark;

use Sabre\Event\Emitter;

include __DIR__.'/../../../vendor/autoload.php';

class BenchMarkOneCallBack extends BenchMark
{
    protected Emitter $emitter;
    protected int $iterations = 100000;

    public function setUp(): void
    {
        $this->emitter = new Emitter();
        $this->emitter->on('foo', function () {
            // NOOP
        });
    }

    public function test(): void
    {
        for ($i = 0; $i < $this->iterations; ++$i) {
            $this->emitter->emit('foo', []);
        }
    }
}
