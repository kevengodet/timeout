<?php
declare(strict_types=1);

namespace Keven\Timeout;

use Throwable;

final class Invoker
{
    /**
     * @param callable $callable
     * @param int $timeoutInSeconds
     * @return mixed
     * @throws Throwable
     */
    public function __invoke(callable $callable, int $timeoutInSeconds = 1)
    {
        pcntl_signal(
            SIGALRM,
            function () use ($timeoutInSeconds): void {
                throw new TimeoutException('Timeout after '.$timeoutInSeconds.'s.');
            },
            true
        );
        pcntl_async_signals(true);
        pcntl_alarm($timeoutInSeconds);
        try {
            $result = $callable();
        } catch (\Throwable $t) {
            pcntl_alarm(0);
            throw $t;
        }

        pcntl_alarm(0);

        return $result;
    }
}
