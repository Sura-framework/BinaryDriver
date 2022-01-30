<?php

namespace Sura\Tests\BinaryDriver\Exceptions;

use Sura\BinaryDriver\BinaryDriverTestCase;
use Sura\BinaryDriver\Exception\ExecutionFailureException;
use Sura\BinaryDriver\ProcessRunner;

class ExecutionFailureExceptionTest extends BinaryDriverTestCase
{
    public function getProcessRunner($logger)
    {
        return new ProcessRunner($logger, 'test-runner');
    }

    public function testGetExceptionInfo(){

        $logger = $this->createLoggerMock();
        $runner = $this->getProcessRunner($logger);

        $process = $this->createProcessMock(1, false, '--helloworld--', null, "Error Output", true);
        try{
            $runner->run($process, new \SplObjectStorage(), false);
            $this->fail('An exception should have been raised');
        }
        catch (ExecutionFailureException $e){
            $this->assertEquals("--helloworld--", $e->getCommand());
            $this->assertEquals("Error Output", $e->getErrorOutput());
        }

    }

}