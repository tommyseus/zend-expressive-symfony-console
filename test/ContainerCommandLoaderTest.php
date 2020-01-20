<?php

declare(strict_types=1);

namespace AlexTartanTest\Mezzio\SymfonyConsole;

use AlexTartan\Mezzio\SymfonyConsole\ContainerCommandLoader;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;

/**
 * @covers \AlexTartan\Mezzio\SymfonyConsole\ContainerCommandLoader
 */
class ContainerCommandLoaderTest extends TestCase
{
    public function testThatGetOverridesTheCommandName(): void
    {
        $dummyCommand = new Command('command-name');

        $container = $this->createMock(ContainerInterface::class);
        $container->expects(self::exactly(2))->method('has')->with('dummy-command')->willReturn(true);
        $container->expects(self::exactly(2))->method('get')->with('dummy-command')->willReturn($dummyCommand);

        $containerCommandLoader = new ContainerCommandLoader(
            $container,
            [
                'dummy:command-name' => 'dummy-command',
            ]
        );

        static::assertSame($dummyCommand, $containerCommandLoader->get('dummy:command-name'));
        static::assertSame('dummy:command-name', $containerCommandLoader->get('dummy:command-name')->getName());
    }
}
