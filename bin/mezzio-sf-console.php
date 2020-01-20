<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Seus\Zend\Expressive\SymfonyConsole;

// require vendor/autoload.php
use Exception;
use Symfony\Component\Console\Application;

if (file_exists($path = __DIR__ . '/../../../autoload.php')) {
    require_once $path;
} else if (file_exists($path = __DIR__ . '/../vendor/autoload.php')) {
    require_once $path;
} else {
    throw new \RuntimeException('Unable to locate \'vendor/autoload.php\'');
}

// get container instance from config/container.php
if (file_exists($path = __DIR__ . '/../../../../config/container.php')) {
    $container = require $path;
} else if (file_exists($path = __DIR__ . '/../config/container.php')) {
    $container = require $path;
} else {
    throw new \RuntimeException('Unable to locate \'config/container.php\'');
}

// get the symfony console application instance
/* @var $application \Symfony\Component\Console\Application */
$application = $container->get(Application::class);

// execute the symfony console application
try {
    exit($application->run());
} catch (Exception $e) {
    exit(255);
}
