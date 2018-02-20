<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Seus\Zend\Expressive\SymfonyConsole;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

class ApplicationFactory
{
    /**
     * Factoy method to create a symfony console application.
     *
     * @param ContainerInterface $container
     *
     * @return Application
     */
    public function __invoke(ContainerInterface $container): Application
    {
        $config = $this->getConfig($container);

        $application = new Application(
            $config['name'] ?? 'Application Console',
            $config['version'] ?? 'UNKNOWN'
        );

        $this->addCommandsToApplication($container, $application, $config['commands'] ?? []);

        return $application;
    }

    /**
     * Get config from the container.
     *
     * @param ContainerInterface $container
     *
     * @return array
     */
    private function getConfig(ContainerInterface $container): array
    {
        return $container->get('config')['seus-zend-expressive-symfony-console'] ?? [];
    }

    /**
     * Adds the commands to the symfony console application.
     *
     * @param ContainerInterface $container
     * @param Application        $application
     * @param array|string[]     $commands
     */
    private function addCommandsToApplication(
        ContainerInterface $container,
        Application $application,
        array $commands
    ): void {
        foreach ($commands as $command) {
            $application->add($container->get($command));
        }
    }
}
