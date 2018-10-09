<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Seus\Zend\Expressive\SymfonyConsole;

use Symfony\Component\Console\Application;

class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'seus-zend-expressive-symfony-console' => [
                'name' => 'Application Console',
                'version' => 'UNKNOWN',
                'commands' => [], // the commands must be registered as a service
            ],
            'dependencies' => [
                'factories' => [
                    Application::class => ApplicationFactory::class,
                ],
            ],
        ];
    }
}
