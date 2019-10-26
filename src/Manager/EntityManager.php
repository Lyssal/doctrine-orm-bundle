<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\Doctrine\OrmBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Lyssal\Doctrine\Orm\Manager\EntityManager as LyssalOrmEntityManager;

/**
 * the entity managers' manager.
 */
class EntityManager
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface The Doctrine entity manager
     */
    protected $entityManager;

    /**
     * @var \Lyssal\Doctrine\Orm\Manager\EntityManager[] The entityManager handlers
     */
    protected $entityManagerHandlers = [];

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
     * Add a entityManager handler.
     *
     * @param \Lyssal\Doctrine\Orm\Manager\EntityManager $entityManagerHandler The entity manager handler
     */
    public function addEntityManagerHandler(LyssalOrmEntityManager $entityManagerHandler): void
    {
        $this->entityManagerHandlers[] = $entityManagerHandler;
    }

    /**
     * Get the manager of the entity.
     *
     * @param string $class The entity class
     * @return \Lyssal\Doctrine\Orm\Manager\EntityManager The entity manager
     */
    public function get(string $class): LyssalOrmEntityManager
    {
        foreach ($this->entityManagerHandlers as $entityManagerHandler) {
            if ($class === $entityManagerHandler->getClass()) {
                return $entityManagerHandler;
            }
        }

        $entityManager = new LyssalOrmEntityManager($this->entityManager, $class);
        $this->addEntityManagerHandler($entityManager);

        return $entityManager;
    }
}
