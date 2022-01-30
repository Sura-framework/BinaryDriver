<?php

/*
 * This file is part of Sura\BinaryDriver.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sura\BinaryDriver;

interface ProcessRunnerAwareInterface
{
    /**
     * Returns the current process runner
     *
     * @return ProcessRunnerInterface
     */
    public function getProcessRunner();

    /**
     * Sets a process runner
     *
     * @param ProcessRunnerInterface $runner
     */
    public function setProcessRunner(ProcessRunnerInterface $runner);
}
