<?php

declare(strict_types=1);

namespace AlexTartan\Mezzio\SymfonyConsole;

use Symfony\Component\Console\Application;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'mezzio-symfony-console' => [
                'name'     => 'Application Console',
                'version'  => 'UNKNOWN',
                'commands' => [], // the commands must be registered as a service
            ],
            'dependencies'           => [
                'factories' => [
                    Application::class => ApplicationFactory::class,
                ],
            ],
        ];
    }
}
