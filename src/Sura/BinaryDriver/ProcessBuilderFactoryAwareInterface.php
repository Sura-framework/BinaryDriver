<?php

/*
 * This file is part of Sura\BinaryDriver.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sura\BinaryDriver;

interface ProcessBuilderFactoryAwareInterface
{
    /**
     * Returns the current process builder factory
     *
     * @return ProcessBuilderFactoryInterface
     */
    public function getProcessBuilderFactory();

    /**
     * Set a process builder factory
     *
     * @param ProcessBuilderFactoryInterface $factory
     */
    public function setProcessBuilderFactory(ProcessBuilderFactoryInterface $factory);
}
