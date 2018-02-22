# zend-expressive symfony console

This project adds a executable file to the composer bin folder to run symfony commands under a zend-expressive
application environment.

## Installation

### Requirements

- PHP 7.1
- a config/container.php file (returns a ContainerInterface instance)

### Composer installation

```bash
$ composer require tommyseus/zend-expressive-symfony-console
```

### Configuration
#### zend-expressive configuration

Add the \Seus\Zend\Expressive\SymfonyConsole\ConfigProvider to the config/config.php file.

#### Configuration of the symfony console application

add this configuration to your application config (ex.: config/autoload/ze-sf-console.global.php)

```php
[
    'seus-zend-expressive-symfony-console' => [
        'name' => 'Console Name',
        'version' => '1.0.0', // optional
        'commands' => [
            // add the command service names here
            // ex.: Command::class,
        ],
    ],

    'dependencies' => [
        'factories' => [
            // add commands as a service to the container
            // ex.: Command::class => CommandFactory::class,
        ],
    ],
],
```

## Run commands

This module adds a executable file under the composer bin directory to execute symfony commands.

```bash
$ vendor/bin/ze-sf-console list
```
