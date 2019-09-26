<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine;

use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrineCategoryId;
use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrineColor;
use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrineContent;
use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrineDescription;
use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrineEmail;
use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrineImageUrl;
use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrineOrder;
use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrinePostId;
use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrineTitle;
use AlexAgile\Infrastructure\Persistence\Doctrine\CustomType\DoctrineUrlSlug;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

final class DoctrineEntityManagerFactory
{
    /** @var array */
    private $entityPaths = [];

    /** @var array */
    private $connectionParams = [];

    /**
     * @throws DBALException
     */
    public function __construct(array $entityPaths, array $connectionParams)
    {
        $this->entityPaths      = $entityPaths;
        $this->connectionParams = $connectionParams;

        if (!Type::hasType('CategoryId')) {
            Type::addType('CategoryId', DoctrineCategoryId::class);
        }

        if (!Type::hasType('Color')) {
            Type::addType('Color', DoctrineColor::class);
        }

        if (!Type::hasType('Content')) {
            Type::addType('Content', DoctrineContent::class);
        }

        if (!Type::hasType('Description')) {
            Type::addType('Description', DoctrineDescription::class);
        }

        if (!Type::hasType('Email')) {
            Type::addType('Email', DoctrineEmail::class);
        }

        if (!Type::hasType('ImageUrl')) {
            Type::addType('ImageUrl', DoctrineImageUrl::class);
        }

        if (!Type::hasType('Order')) {
            Type::addType('Order', DoctrineOrder::class);
        }

        if (!Type::hasType('PostId')) {
            Type::addType('PostId', DoctrinePostId::class);
        }

        if (!Type::hasType('Title')) {
            Type::addType('Title', DoctrineTitle::class);
        }

        if (!Type::hasType('UrlSlug')) {
            Type::addType('UrlSlug', DoctrineUrlSlug::class);
        }
    }

    /**
     * @throws ORMException
     */
    public function getEntityManager(): EntityManager
    {
        $isDevMode = true;
        $proxyDir  = null;
        $cache     = new ArrayCache();

        $config = Setup::createXMLMetadataConfiguration(
            $this->entityPaths,
            $isDevMode,
            $proxyDir,
            $cache
        );

        $driver = new \Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver($this->entityPaths);
        $config->setMetadataDriverImpl($driver);

        $entityManager = EntityManager::create($this->connectionParams, $config);

        return $entityManager;
    }
}
