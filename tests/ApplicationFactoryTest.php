<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SeusTest\Zend\Expressive\SymfonyConsole;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Seus\Zend\Expressive\SymfonyConsole\ApplicationFactory;
use Symfony\Component\Console as SymfonyConsole;

/**
 * @covers \Seus\Zend\Expressive\SymfonyConsole\ApplicationFactory
 */
class ApplicationFactoryTest extends TestCase
{
    public function testFactory01(): void
    {
        $config = [];

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')->willReturn($config);

        $applicationFactory = new ApplicationFactory();
        $application = $applicationFactory($container->reveal());

        $this->assertInstanceOf(SymfonyConsole\Application::class, $application);
        $this->assertSame('Application Console', $application->getName());
        $this->assertSame('UNKNOWN', $application->getVersion());
    }

    public function testFactory02(): void
    {
        $config = [
            'seus-zend-expressive-symfony-console' => [
                'name' => 'dummy application name',
                'version' => '1.2.3',
                'commands' => [
                    'dummy-command',
                ],
            ],
        ];

        $dummyCommand = new SymfonyConsole\Command\Command('dummy-command');

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')->willReturn($config);
        $container->has('dummy-command')->willReturn(true);
        $container->get('dummy-command')->willReturn($dummyCommand);

        $applicationFactory = new ApplicationFactory();
        $application = $applicationFactory($container->reveal());

        $this->assertInstanceOf(SymfonyConsole\Application::class, $application);
        $this->assertSame('dummy application name', $application->getName());
        $this->assertSame('1.2.3', $application->getVersion());
        $this->assertSame($dummyCommand, $application->get('dummy-command'));
    }

    public function testFactory03(): void
    {
        $config = [
            'seus-zend-expressive-symfony-console' => [
                'name' => 'dummy application name',
                'version' => '1.2.3',
                'commands' => [
                    'dummy:command-name' => 'dummy-command',
                ],
            ],
        ];

        $dummyCommand = new SymfonyConsole\Command\Command('command-name');

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('config')->willReturn($config);
        $container->has('dummy-command')->willReturn(true);
        $container->get('dummy-command')->willReturn($dummyCommand);

        $applicationFactory = new ApplicationFactory();
        $application = $applicationFactory($container->reveal());

        $this->assertInstanceOf(SymfonyConsole\Application::class, $application);
        $this->assertSame('dummy application name', $application->getName());
        $this->assertSame('1.2.3', $application->getVersion());
        $this->assertSame($dummyCommand, $application->get('dummy:command-name'));
        $this->assertSame('dummy:command-name', $application->get('dummy:command-name')->getName());
    }
}
