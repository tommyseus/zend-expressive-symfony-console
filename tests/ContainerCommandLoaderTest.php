<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SeusTest\Zend\Expressive\SymfonyConsole;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Seus\Zend\Expressive\SymfonyConsole\ContainerCommandLoader;
use Symfony\Component\Console\Command\Command;

/**
 * @covers \Seus\Zend\Expressive\SymfonyConsole\ContainerCommandLoader
 */
class ContainerCommandLoaderTest extends TestCase
{
    public function testThatGetOverridesTheCommandName(): void
    {
        $dummyCommand = new Command('command-name');

        $container = $this->prophesize(ContainerInterface::class);
        $container->has('dummy-command')->willReturn(true);
        $container->get('dummy-command')->willReturn($dummyCommand);

        $containerCommandLoader = new ContainerCommandLoader(
            $container->reveal(),
            [
                'dummy:command-name' => 'dummy-command',
            ]
        );

        $this->assertSame($dummyCommand, $containerCommandLoader->get('dummy:command-name'));
        $this->assertSame('dummy:command-name', $containerCommandLoader->get('dummy:command-name')->getName());
    }
}
