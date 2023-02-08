<?php

declare(strict_types=1);

namespace Sabre\Event\Loop;

class LoopTest extends \PHPUnit\Framework\TestCase
{
    public function testNextTick(): void
    {
        $loop = new Loop();
        $check = 0;
        $loop->nextTick(function () use (&$check) {
            ++$check;
        });

        $loop->run();

        self::assertEquals(1, $check);
    }

    public function testTimeout(): void
    {
        $loop = new Loop();
        $check = 0;
        $loop->setTimeout(function () use (&$check) {
            ++$check;
        }, 0.02);

        $loop->run();

        self::assertEquals(1, $check);
    }

    public function testTimeoutOrder(): void
    {
        $loop = new Loop();
        $check = [];
        $loop->setTimeout(function () use (&$check) {
            $check[] = 'a';
        }, 0.2);
        $loop->setTimeout(function () use (&$check) {
            $check[] = 'b';
        }, 0.1);
        $loop->setTimeout(function () use (&$check) {
            $check[] = 'c';
        }, 0.3);

        $loop->run();

        self::assertEquals(['b', 'a', 'c'], $check);
    }

    public function testSetInterval(): void
    {
        $loop = new Loop();
        $check = 0;
        $intervalId = null;
        $intervalId = $loop->setInterval(function () use (&$check, &$intervalId, $loop) {
            ++$check;
            if ($check > 5) {
                if (null === $intervalId) {
                    throw new \Exception('intervalId is not set - cannot clearInterval');
                }
                $loop->clearInterval($intervalId);
            }
        }, 0.02);

        $loop->run();
        self::assertEquals(6, $check);
    }

    public function testAddWriteStream(): void
    {
        $h = fopen('php://temp', 'r+');
        if (false === $h) {
            $this->fail('failed to open php://temp');
        }
        $loop = new Loop();
        $loop->addWriteStream($h, function () use ($h, $loop) {
            fwrite($h, 'hello world');
            $loop->removeWriteStream($h);
        });
        $loop->run();
        rewind($h);
        self::assertEquals('hello world', stream_get_contents($h));
    }

    public function testAddReadStream(): void
    {
        $h = fopen('php://temp', 'r+');
        if (false === $h) {
            $this->fail('failed to open php://temp');
        }
        fwrite($h, 'hello world');
        rewind($h);

        $loop = new Loop();

        $result = null;

        $loop->addReadStream($h, function () use ($h, $loop, &$result) {
            $result = fgets($h);
            $loop->removeReadStream($h);
        });
        $loop->run();
        self::assertEquals('hello world', $result);
    }

    public function testStop(): void
    {
        $check = 0;
        $loop = new Loop();
        $loop->setTimeout(function () use (&$check) {
            ++$check;
        }, 200);

        $loop->nextTick(function () use ($loop) {
            $loop->stop();
        });
        $loop->run();

        self::assertEquals(0, $check);
    }

    public function testTick(): void
    {
        $check = 0;
        $loop = new Loop();
        $loop->setTimeout(function () use (&$check) {
            ++$check;
        }, 1);

        $loop->nextTick(function () use (&$check) {
            ++$check;
        });
        $loop->tick();

        self::assertEquals(1, $check);
    }

    /**
     * Here we add a new nextTick function as we're in the middle of a current
     * nextTick.
     */
    public function testNextTickStacking(): void
    {
        $loop = new Loop();
        $check = 0;
        $loop->nextTick(function () use (&$check, $loop) {
            $loop->nextTick(function () use (&$check) {
                ++$check;
            });
            ++$check;
        });

        $loop->run();

        self::assertEquals(2, $check);
    }
}
