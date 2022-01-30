<?php

namespace Sura\Tests\BinaryDriver;

use Sura\BinaryDriver\ProcessBuilderFactory;

class LTSProcessBuilderFactoryTest extends AbstractProcessBuilderFactoryTest
{
    public function testSetUp()
    {
        if (!class_exists('Symfony\Component\Process\ProcessBuilder')) {
            $this->markTestSkipped('ProcessBuilder is not available.');
//            return false;
        }

        parent::setUp();
    }

    protected function getProcessBuilderFactory($binary)
    {
        $factory = new ProcessBuilderFactory($binary);
        $factory->setBuilder(new LTSProcessBuilder());
        ProcessBuilderFactory::$emulateSfLTS = false;
        $factory->useBinary($binary);

        return $factory;
    }
}
