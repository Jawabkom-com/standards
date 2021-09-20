<?php

namespace Jawabkom\Standard\Test\Unit;

use Jawabkom\Standard\Abstract\AbstractService;
use Jawabkom\Standard\Contract\IDependencyInjector;
use Jawabkom\Standard\Test\AbstractTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class AbstractServiceTest extends AbstractTestCase
{

    /**
     * @var IDependencyInjector|MockObject
     */
    private mixed $di;

    /**
     * @var AbstractService|MockObject
     */
    private mixed $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->di = $this->getMockForAbstractClass(IDependencyInjector::class);
        $this->service = $this->getMockForAbstractClass(AbstractService::class, ['di' => $this->di]);
    }

    public function testInputs()
    {
        $this->service->input('input1Key', 'input1Value');
        $this->assertEquals('input1Value', self::callInaccessibleMethod($this->service, 'getInput', ['key' => 'input1Key']));

        $this->service->inputs([
            'input2Key' => 'input2Value',
            'input3Key' => 'input3Value',
        ]);
        $inputs = self::callInaccessibleMethod($this->service, 'getInputs');
        $this->assertEquals(count($inputs), 3);
        $this->assertEquals('input2Value', $inputs['input2Key']);
        $this->assertEquals('input3Value', $inputs['input3Key']);
    }

    public function testOutputs()
    {
        self::callInaccessibleMethod($this->service, 'setOutput', ['key' => 'output1Key', 'value' => 'output1Value']);
        self::callInaccessibleMethod($this->service, 'setOutput', ['key' => 'output2Key', 'value' => 'output2Value']);

        $this->assertEquals('output1Value', $this->service->output('output1Key'));
        $this->assertEquals(count($this->service->outputs()), 2);
    }

}