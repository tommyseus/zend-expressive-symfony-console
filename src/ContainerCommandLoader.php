<?php

declare(strict_types=1);

namespace AlexTartan\Mezzio\SymfonyConsole;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader as SymfonyContainerCommandLoader;

/**
 * The command name is always overwritten with the one from the config to make it uniform.
 */
class ContainerCommandLoader extends SymfonyContainerCommandLoader
{
    public function get(string $name): Command
    {
        $command = parent::get($name);
        $command->setName($name);

        return $command;
    }
}
