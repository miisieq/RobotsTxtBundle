# MiisieqRobotsTxtBundle

|       SensioLabsInsight        |        Style-CI         |         Coverage        |        Downloads        |         Release         |
|:----------------------:|:-----------------------:|:-----------------------:|:-----------------------:|:-----------------------:|
| [![SensioLabsInsight](https://insight.sensiolabs.com/projects/1aed0267-a4e2-4322-88cf-7dcbc2a4d8bd/mini.png)](https://insight.sensiolabs.com/projects/1aed0267-a4e2-4322-88cf-7dcbc2a4d8bd) | [![StyleCI](https://styleci.io/repos/105973219/shield?branch=master)](https://styleci.io/repos/105973219) | [![Coverage Status](https://coveralls.io/repos/github/miisieq/RobotsTxtBundle/badge.svg?branch=master)](https://coveralls.io/github/miisieq/RobotsTxtBundle?branch=master) | [![Total Downloads](https://poser.pugx.org/miisieq/robots-txt-bundle/downloads?format=flat-square)](https://packagist.org/packages/miisieq/robots-txt-bundle) | [![Latest Stable Version](https://poser.pugx.org/miisieq/robots-txt-bundle/v/stable?format=flat-square)](https://packagist.org/packages/miisieq/robots-txt-bundle) |

## Installation

First, open a command console, enter your project directory and execute the following command to download the latest version of this bundle:

```
composer miisieq/robots-txt-bundle
```

Then add the bundle to your kernel:
```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...

            new Miisieq\RobotsTxtBundle\MiisieqRobotsTxtBundle(),
        ];

        // ...
    }
}
```

Remove static `robots.txt` file:
```bash
rm web/robots.txt
```
To allow to get your `robots.txt` file, register the following route:

```yml
# app/config/routing.yml
miisieq_robots_txt:
    resource: "@MiisieqRobotsTxtBundle/Controller/"
    type:     annotation
```