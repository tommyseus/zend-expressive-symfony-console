<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SeusTest\Zend\Expressive\SymfonyConsole;

use PHPUnit\Framework\TestCase;
use Seus\Zend\Expressive\SymfonyConsole\Application;
use Seus\Zend\Expressive\SymfonyConsole\ApplicationFactory;
use Seus\Zend\Expressive\SymfonyConsole\ConfigProvider;

/**
 * @covers \Seus\Zend\Expressive\SymfonyConsole\ConfigProvider
 */
class ConfigProviderTest extends TestCase
{
    public function testInvoke(): void
    {
        $configProvider = new ConfigProvider();

        $config = $configProvider();

        $this->assertInternalType('array', $config);
        $this->assertArrayHasKey('seus-zend-expressive-symfony-console', $config);
        $this->assertSame(
            [
                'name' => 'Application Console',
                'version' => 'UNKNOWN',
                'commands' => [],
            ],
            $config['seus-zend-expressive-symfony-console']
        );
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertArrayHasKey('factories', $config['dependencies']);
        $this->assertArrayHasKey(Application::class, $config['dependencies']['factories']);
        $this->assertSame(ApplicationFactory::class, $config['dependencies']['factories'][Application::class]);
    }
}
