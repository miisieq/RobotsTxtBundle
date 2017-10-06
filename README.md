# MiisieqRobotsTxtBundle

|       SensioLabsInsight        |        Style-CI         |         Coverage        |        Downloads        |         Release         |
|:----------------------:|:-----------------------:|:-----------------------:|:-----------------------:|:-----------------------:|
| [![SensioLabsInsight](https://insight.sensiolabs.com/projects/1aed0267-a4e2-4322-88cf-7dcbc2a4d8bd/mini.png)](https://insight.sensiolabs.com/projects/1aed0267-a4e2-4322-88cf-7dcbc2a4d8bd) | [![StyleCI](https://styleci.io/repos/105973219/shield?branch=master)](https://styleci.io/repos/105973219) | [![Coverage Status](https://coveralls.io/repos/github/miisieq/RobotsTxtBundle/badge.svg?branch=master)](https://coveralls.io/github/miisieq/RobotsTxtBundle?branch=master) | [![Total Downloads](https://poser.pugx.org/miisieq/robots-txt-bundle/downloads?format=flat-square)](https://packagist.org/packages/miisieq/robots-txt-bundle) | [![Latest Stable Version](https://poser.pugx.org/miisieq/robots-txt-bundle/v/stable?format=flat-square)](https://packagist.org/packages/miisieq/robots-txt-bundle) |

## The problem
It's pretty common workflow that we work on our projects in `local` environment, then deploy code to `preproduction` or `staging` server for out client to approve the work, then finally push to `production` environment.

While we absolutely want crawlers to index our `production` environment, we don't want to see our test servers in search results.

## How it works?
Depending on the Symfony environment, application will return `robots.txt` file with rule that allows to index whole content only we are in `prod` environment. In case of another environment, the application will block whole site from indexing.

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
