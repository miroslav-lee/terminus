<?php

namespace Pantheon\Terminus\Tests\Functional;

use Pantheon\Terminus\Tests\Traits\TerminusTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class AliasesCommandTest
 *
 * @package Pantheon\Terminus\Tests\Functional
 */
class AliasesCommandTest extends TestCase
{
    use TerminusTestTrait;

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    protected function setUp(): void
    {
        if (!$this->isSiteFrameworkDrupal()) {
            $this->markTestSkipped(
                'A Drupal-based test site is required to test Drush-related "drush:aliases" command.'
            );
        }
    }

    /**
     * @test
     * @covers \Pantheon\Terminus\Commands\AliasesCommand
     *
     * @throws \Exception
     *
     * @group aliases
     */
    public function testGetAliases()
    {
        $command = sprintf('drush:aliases --only=%s  --print', $this->getSiteName());

        $aliases = $this->terminus($command);

        $this->assertIsString($aliases);

        $aliases_needle = sprintf('$aliases[\'%s.*\']', $this->getSiteId());
        $this->assertTrue(false !== strpos($aliases, $aliases_needle));
    }
}
