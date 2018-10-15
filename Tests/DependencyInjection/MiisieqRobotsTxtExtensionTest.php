<?php

/*
 * This file is part of the `miisieq/RobotsTxtBundle` project.
 *
 * (c) https://github.com/miisieq/RobotsTxtBundle/graphs/contributors
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Miisieq\RobotsTxtBundle\Tests\DependencyInjection;

use Miisieq\RobotsTxtBundle\DependencyInjection\MiisieqRobotsTxtExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\HttpKernel\KernelInterface;

class MiisieqRobotsTxtExtensionTest extends TestCase
{
    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var Container
     */
    private $container;

    public static function assertSaneContainer(Container $container): void
    {
        $errors = array();

        foreach ($container->getServiceIds() as $id) {
            try {
                $container->get($id);
            } catch (\Exception $e) {
                $errors[$id] = $e->getMessage();
            }
        }

        self::assertEquals(array(), $errors);
    }

    protected function setUp(): void
    {
        $this->kernel = $this->getMockBuilder('Symfony\\Component\\HttpKernel\\KernelInterface')->getMock();
        $this->container = new ContainerBuilder();
        $this->container
            ->register(
                'miisieq_robots_txt_bundle.generator',
                'Miisieq\RobotsTxtBundle\Generator\Generator'
            )
            ->setPublic(true);
        $this->container
            ->register(
                'miisieq_robots_txt_bundle.robots_controller',
                'Miisieq\RobotsTxtBundle\Controller\RobotsController'
            )
            ->addArgument(new Reference('miisieq_robots_txt_bundle.generator'))
            ->setPublic(true);
        $this->container->setParameter('kernel.environment', 'dev');
        $this->container->set('kernel', $this->kernel);
        $this->container->addCompilerPass(new RegisterListenersPass());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->container = null;
        $this->kernel = null;
    }

    public function testDefaultConfig(): void
    {
        $extension = new MiisieqRobotsTxtExtension();
        $extension->load([[]], $this->container);
        $this->assertSaneContainer($this->getCompiledContainer());
    }

    /**
     * @return Container
     */
    private function getCompiledContainer(): Container
    {
        $this->container->compile();
        $this->container->set('kernel', $this->kernel);

        return $this->container;
    }
}
