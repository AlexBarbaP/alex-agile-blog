<?php
declare(strict_types=1);

namespace AlexAgile\Tests;

use AlexAgile\Infrastructure\Persistence\Doctrine\DoctrineEntityManagerFactory;
use AlexAgile\Tests\Integration\Fixture\Category\DoctrineCategoryFixtureLoader;
use AlexAgile\Tests\Integration\Fixture\ContactRequest\DoctrineContactRequestFixtureLoader;
use AlexAgile\Tests\Integration\Fixture\Post\DoctrinePostFixtureLoader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;

trait DoctrineAwareTestTrait
{
    /** @var EntityManager */
    protected $entityManager;

    protected function setUpEntityManager(): void
    {
        $entityPaths = [
            __DIR__ . '/../../src/AlexAgile/Infrastructure/Persistence/Doctrine/ContactRequest/Mapping' => 'AlexAgile\Domain\ContactRequest',
            __DIR__ . '/../../src/AlexAgile/Infrastructure/Persistence/Doctrine/Category/Mapping' => 'AlexAgile\Domain\Category',
            __DIR__ . '/../../src/AlexAgile/Infrastructure/Persistence/Doctrine/Post/Mapping' => 'AlexAgile\Domain\Post',
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
        $loader->addFixture(new DoctrineCategoryFixtureLoader());
        $loader->addFixture(new DoctrineContactRequestFixtureLoader());
        $loader->addFixture(new DoctrinePostFixtureLoader());

        $purger   = new ORMPurger();
        $executor = new ORMExecutor($this->entityManager, $purger);
        $executor->execute($loader->getFixtures());
    }
}
