<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Seus\Zend\Expressive\SymfonyConsole;

use Symfony\Component\Console\CommandLoader\ContainerCommandLoader as SymfonyContainerCommandLoader;

/**
 * The command name is always overwritten with the one from the config to make it uniform.
 */
class ContainerCommandLoader extends SymfonyContainerCommandLoader
{
    public function get($name)
    {
        $command = parent::get($name);
        $command->setName($name);

        return $command;
    }
}
