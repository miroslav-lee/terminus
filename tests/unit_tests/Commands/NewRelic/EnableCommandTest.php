<?php

namespace Pantheon\Terminus\UnitTests\Commands\NewRelic;

use Pantheon\Terminus\Commands\NewRelic\EnableCommand;
use Pantheon\Terminus\Models\Workflow;
use Pantheon\Terminus\UnitTests\Commands\WorkflowProgressTrait;

/**
 * Class EnableCommandTest
 * Testing class for Pantheon\Terminus\Commands\NewRelic\EnableCommand
 * @package Pantheon\Terminus\UnitTests\Commands\NewRelic
 */
class EnableCommandTest extends NewRelicCommandTest
{
    use WorkflowProgressTrait;

    /**
     * @inheritdoc
     */
    public function set_up()
    {
        parent::set_up();

        $this->command = new EnableCommand();
        $this->command->setContainer($this->getContainer());
        $this->command->setSites($this->sites);
        $this->command->setLogger($this->logger);
        $this->expectWorkflowProcessing();
    }

    public function testEnable()
    {
        $workflow = $this->getMockBuilder(Workflow::class)
            ->disableOriginalConstructor()
            ->getMock();
        // workflow succeeded
        $workflow->expects($this->once())
            ->method('getMessage')
            ->with()
            ->willReturn('successful workflow');

        $this->new_relic->expects($this->once())
            ->method('enable')
            ->willReturn($workflow);

        $this->logger->expects($this->at(0))
            ->method('log')->with(
                $this->equalTo('notice'),
                $this->equalTo('successful workflow')
            );

        $out = $this->command->enable('mysite');
        $this->assertNull($out);
    }
}
