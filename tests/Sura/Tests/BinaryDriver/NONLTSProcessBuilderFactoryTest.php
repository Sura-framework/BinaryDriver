<?php

namespace Sura\Tests\BinaryDriver;

use Sura\BinaryDriver\ProcessBuilderFactory;

class NONLTSProcessBuilderFactoryTest extends AbstractProcessBuilderFactoryTest
{
    protected function getProcessBuilderFactory($binary)
    {
        ProcessBuilderFactory::$emulateSfLTS = true;

        return new ProcessBuilderFactory($binary);
    }
}
