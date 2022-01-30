<?php

/*
 * This file is part of Sura\BinaryDriver.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sura\BinaryDriver;

use Sura\BinaryDriver\Exception\ExecutionFailureException;
use Psr\Log\LoggerAwareInterface;
use SplObjectStorage;
use Symfony\Component\Process\Process;

interface ProcessRunnerInterface extends LoggerAwareInterface
{
    /**
     * Executes a process, logs events
     *
     * @param Process          $process
     * @param SplObjectStorage $listeners    Some listeners
     * @param Boolean          $bypassErrors Set to true to disable throwing ExecutionFailureExceptions
     *
     * @return string The Process output
     *
     * @throws ExecutionFailureException in case of process failure.
     */
    public function run(Process $process, SplObjectStorage $listeners, $bypassErrors);
}
