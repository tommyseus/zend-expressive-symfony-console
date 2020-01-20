<?php

declare(strict_types=1);

namespace AlexTartan\Mezzio\SymfonyConsole;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;

use function is_int;

/** Factory to create a symfony console application.*/
class ApplicationFactory
{
    /** Factory method to create a symfony console application.*/
    public function __invoke(ContainerInterface $container): Application
    {
        $config = $this->getConfig($container);

        $application = new Application(
            $config['name'] ?? 'Application Console',
            $config['version'] ?? 'UNKNOWN'
        );
        $application->setCommandLoader($this->createCommandLoader($container, $config['commands'] ?? []));

        return $application;
    }

    /**
     * Get config from the container.
     */
    private function getConfig(ContainerInterface $container): array
    {
        return $container->get('config')['mezzio-symfony-console'] ?? [];
    }

    /**
     * Create CommandLoader for the symfony console application.
     *
     * @param string[] $commands
     */
    private function createCommandLoader(
        ContainerInterface $container,
        array $commands
    ): CommandLoaderInterface {
        $commandMap = [];

        foreach ($commands as $name => $serviceKey) {
            if (is_int($name)) {
                // name is not defined
                /* @var $command Command */
                $command = $container->get($serviceKey);
                $name    = $command->getName();
            }

            $commandMap[$name] = $serviceKey;
        }

        return new ContainerCommandLoader($container, $commandMap);
    }
}
