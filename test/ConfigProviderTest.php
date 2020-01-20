<?php

declare(strict_types=1);

namespace AlexTartanTest\Mezzio\SymfonyConsole;

use AlexTartan\Mezzio\SymfonyConsole\ApplicationFactory;
use AlexTartan\Mezzio\SymfonyConsole\ConfigProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;

/**
 * @covers \AlexTartan\Mezzio\SymfonyConsole\ConfigProvider
 */
class ConfigProviderTest extends TestCase
{
    public function testInvoke(): void
    {
        $configProvider = new ConfigProvider();

        $config = $configProvider();

        static::assertArrayHasKey('mezzio-symfony-console', $config);
        static::assertSame(
            [
                'name'     => 'Application Console',
                'version'  => 'UNKNOWN',
                'commands' => [],
            ],
            $config['mezzio-symfony-console']
        );
        static::assertArrayHasKey('dependencies', $config);
        static::assertArrayHasKey('factories', $config['dependencies']);
        static::assertArrayHasKey(Application::class, $config['dependencies']['factories']);
        static::assertSame(ApplicationFactory::class, $config['dependencies']['factories'][Application::class]);
    }
}
