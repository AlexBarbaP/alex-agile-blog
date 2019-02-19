<?php
declare(strict_types=1);

namespace Growonic\Tests;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Growonic\Infrastructure\Persistence\Doctrine\DoctrineEntityManagerFactory;
use Growonic\Tests\Integration\Fixture\User\DoctrineUserFixtureLoader;

trait DoctrineAwareTestTrait
{
    /** @var EntityManager */
    protected $entityManager;

    protected function setUpEntityManager(): void
    {
        $entityPaths = [
            __DIR__ . '/../../src/Growonic/Infrastructure/Persistence/Doctrine/User/Mapping' => 'Growonic\Domain\User',
        ];

        $dbParams = [
            'url'     => $_ENV['DATABASE_URL'],
            'charset'  => 'utf8',
        ];

        $doctrineEntityManagerFactory = new DoctrineEntityManagerFactory($entityPaths, $dbParams);

        $this->entityManager = $doctrineEntityManagerFactory->getEntityManager();
    }

    protected function fixturesLoader(): void
    {
        $loader = new Loader();
        $loader->addFixture(new DoctrineUserFixtureLoader());

        $purger   = new ORMPurger();
        $executor = new ORMExecutor($this->entityManager, $purger);
        $executor->execute($loader->getFixtures());
    }
}
