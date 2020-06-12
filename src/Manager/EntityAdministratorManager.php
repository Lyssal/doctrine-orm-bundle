<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\Doctrine\OrmBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Lyssal\Doctrine\Orm\Administrator\EntityAdministrator;
use Lyssal\Doctrine\Orm\Administrator\EntityAdministratorInterface;
use Traversable;

/**
 * the entity administrators' manager.
 */
class EntityAdministratorManager
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface The Doctrine entity manager
     */
    protected $entityManager;

    /**
     * @var \Lyssal\Doctrine\Orm\Administrator\EntityAdministratorInterface[] The entity administrator handlers
     */
    protected $entityAdministrators = [];

    /**
     * Constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager The Doctrine entity manager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Set entity administrators.
     *
     * @param \Lyssal\Doctrine\Orm\Administrator\EntityAdministratorInterface[] $entityAdministrators The entity administrators
     */
    public function addEntityAdministrators(Traversable $entityAdministrators): void
    {
        foreach ($entityAdministrators as $entityAdministrator) {
            $this->addEntityAdministrator($entityAdministrator);
        }
    }

    /**
     * Add an entity administrator.
     *
     * @param \Lyssal\Doctrine\Orm\Administrator\EntityAdministratorInterface $entityAdministrator The entity administrator
     */
    public function addEntityAdministrator(EntityAdministratorInterface $entityAdministrator): void
    {
        $this->entityAdministrators[] = $entityAdministrator;
    }

    /**
     * Get the administrator of the entity.
     *
     * @param string $class The entity class
     * @return \Lyssal\Doctrine\Orm\Administrator\EntityAdministratorInterface The entity administrator
     */
    public function get(string $class): EntityAdministratorInterface
    {
        foreach ($this->entityAdministrators as $entityAdministrator) {
            if ($class === $entityAdministrator->getClass()) {
                return $entityAdministrator;
            }
        }

        $entityAdministrator = new EntityAdministrator($this->entityManager, $class);
        $this->addEntityAdministrator($entityAdministrator);

        return $entityAdministrator;
    }
}
