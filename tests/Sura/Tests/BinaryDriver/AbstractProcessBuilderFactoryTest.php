<?php

namespace Sura\Tests\BinaryDriver;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\ExecutableFinder;
use Sura\BinaryDriver\ProcessBuilderFactory;

abstract class AbstractProcessBuilderFactoryTest extends TestCase
{
    public static $phpBinary;

    /**
     * @return ProcessBuilderFactory
     */
    abstract protected function getProcessBuilderFactory($binary);

    public function testSetUp()
    {
        ProcessBuilderFactory::$emulateSfLTS = null;
////        if (null !== static::$phpBinary) {
////            $this->markTestSkipped('Unable to detect php binary, skipping');
////            $this->markTestSkipped('Detect php binary, skipping');
////        }
    }

    public static function testSetUpBeforeClass()
    {
        $finder = new ExecutableFinder();
        self::$phpBinary = $finder->find('php');
        return;
    }

    public function testThatBinaryIsSetOnConstruction()
    {
        $factory = $this->getProcessBuilderFactory(self::$phpBinary);
        $this->assertEquals(self::$phpBinary, $factory->getBinary());
    }

    public function testGetSetBinary()
    {
        $finder = new ExecutableFinder();
        $phpUnit = $finder->find('phpunit');

        if (null === $phpUnit) {
            $this->markTestSkipped('Unable to detect phpunit binary, skipping');
        }

        $factory = $this->getProcessBuilderFactory(self::$phpBinary);
        $factory->useBinary($phpUnit);
        $this->assertEquals($phpUnit, $factory->getBinary());
    }

    /**
     * @expectedException Sura\BinaryDriver\Exception\InvalidArgumentException
     */
    public function testUseNonExistantBinary()
    {
        $factory = $this->getProcessBuilderFactory(self::$phpBinary);
        $factory->useBinary('itissureitdoesnotexist');
    }

    public function testCreateShouldReturnAProcess()
    {
        $factory = $this->getProcessBuilderFactory(self::$phpBinary);
        $process = $factory->create();

        $this->assertInstanceOf('Symfony\Component\Process\Process', $process);
        $this->assertEquals("'".self::$phpBinary."'", $process->getCommandLine());
    }

    public function testCreateWithStringArgument()
    {
        $factory = $this->getProcessBuilderFactory(self::$phpBinary);
        $process = $factory->create('-v');

        $this->assertInstanceOf('Symfony\Component\Process\Process', $process);
        $this->assertEquals("'".self::$phpBinary."' '-v'", $process->getCommandLine());
    }

    public function testCreateWithArrayArgument()
    {
        $factory = $this->getProcessBuilderFactory(self::$phpBinary);
        $process = $factory->create(array('-r', 'echo "Hello !";'));

        $this->assertInstanceOf('Symfony\Component\Process\Process', $process);
        $this->assertEquals("'".self::$phpBinary."' '-r' 'echo \"Hello !\";'", $process->getCommandLine());
    }

    public function testCreateWithTimeout()
    {
        $factory = $this->getProcessBuilderFactory(self::$phpBinary);
        $factory->setTimeout(200);
        $process = $factory->create(array('-i'));

        $this->assertInstanceOf('Symfony\Component\Process\Process', $process);
        $this->assertEquals(200, $process->getTimeout());
    }
}
