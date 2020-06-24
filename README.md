Current build status
===
![CI](https://github.com/alextartan/mezzio-symfony-console/workflows/CI/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/alextartan/mezzio-symfony-console/branch/master/graph/badge.svg)](https://codecov.io/gh/alextartan/mezzio-symfony-console)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Falextartan%2Fmezzio-symfony-console%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/alextartan/mezzio-symfony-console/master)
[![Dependabot Status](https://api.dependabot.com/badges/status?host=github&repo=alextartan/mezzio-symfony-console)](https://dependabot.com)
[![Downloads](https://img.shields.io/badge/dynamic/json.svg?url=https://repo.packagist.org/packages/alextartan/mezzio-symfony-console.json&label=Downloads&query=$.package.downloads.total&colorB=orange)](https://packagist.org/packages/alextartan/mezzio-symfony-console)



# mezzio symfony console

This project adds a executable file to the composer bin folder to run symfony commands under a zend-expressive
application environment.

## Installation

### Requirements

- PHP 7.3
- a config/container.php file (returns a ContainerInterface instance)

### Composer installation

```bash
$ composer require alextartan/mezzio-symfony-console
```

### Configuration
#### zend-expressive configuration

Add the \AlexTartan\Mezzio\SymfonyConsole\ConfigProvider to the config/config.php file.

#### Configuration of the symfony console application

- Add this configuration to your application config (ex.: config/autoload/mezzio-sf-console.global.php).
- It is recommended to define the command name.

```php
[
    'mezzio-symfony-console' => [
        'name' => 'Console Name',
        'version' => '1.0.0', // optional
        'commands' => [
            // add the command service names here
            // ex.: 'foo:bar' => Command::class, // recommended, lazy
            // ex.: Command::class, // not lazy
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
$ vendor/bin/mezzio-sf-console list
```
