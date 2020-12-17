<?php

namespace Pantheon\Terminus\UnitTests\Commands\Env;

use Pantheon\Terminus\UnitTests\Commands\CommandTestCase;

use Pantheon\Terminus\Models\Workflow;

/**
 * Class EnvCommandTest
 * Base class for the environment tests
 * @package Pantheon\Terminus\UnitTests\Commands\Env
 */
abstract class EnvCommandTest extends CommandTestCase
{
    /**
     * @var Workflow
     */
    protected $workflow;

    /**
     * @inheritdoc
     */
    protected function set_up()
    {
        parent::set_up();
        $this->workflow = $this->getMockBuilder(Workflow::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
