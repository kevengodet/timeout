<?php

namespace Keven\Tests\Timeout;

use Keven\Timeout\TimeoutException;
use PHPUnit\Framework\TestCase;
use Keven\Timeout\Invoker;

final class InvokerTest extends TestCase
{
    public function testOk()
    {
        $timeout = new Invoker;
        $this->assertEquals('ok', $timeout(function() { sleep(1); return 'ok'; }, 2));
    }

    public function testTimeout()
    {
        $this->expectException(TimeoutException::class);
        $timeout = new Invoker;
        $timeout(function() { sleep(2); }, 1);
    }

    public function testRetrowingException()
    {
        $this->expectException(\OutOfBoundsException::class);
        $timeout = new Invoker;
        $timeout(function() { throw new \OutOfBoundsException(); });
    }
}
