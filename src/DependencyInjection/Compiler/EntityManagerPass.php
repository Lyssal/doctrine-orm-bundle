<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\Doctrine\OrmBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * The compiler pass for entity managers.
 */
class EntityManagerPass implements CompilerPassInterface
{
    /**
     * Process the compiler pass.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container
     */
    public function process(ContainerBuilder $container)
    {
        $services = $container->findTaggedServiceIds('lyssal.entity_manager');
        $managerService = $container->getDefinition('lyssal.entity_manager');

        foreach (array_keys($services) as $id) {
            $managerService->addMethodCall('addEntityManagerHandler', array(new Reference($id)));
        }
    }
}
