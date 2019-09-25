<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\Category;

use AlexAgile\Domain\Category\CategoryRepositoryInterface;
use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Category\CategoryId;
use AlexAgile\Domain\Category\CategoryNotFoundException;
use AlexAgile\Domain\ValueObject\UrlSlug;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;

final class CategoryRepositoryDoctrineAdapter implements CategoryRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function find(CategoryId $categoryId): ?Category
    {
        try {
            return $this->em->getRepository(Category::class)->find($categoryId);
        } catch (NoResultException $e) {
            throw new CategoryNotFoundException('Category not found');
        }
    }

    /**
     * @throws CategoryNotFoundException
     */
    public function findByUrlSlug(UrlSlug $urlSlug): ?Category
    {
        try {
            $queryBuilder = $this->em->createQueryBuilder();
            $query        = $queryBuilder->select('c')
                                         ->from('AlexAgile\Domain\Category\Category', 'c')
                                         ->where('c.urlSlug = :urlSlug')
                                         ->setParameter('urlSlug', $urlSlug->urlSlug())
                                         ->getQuery();

            return $query->getSingleResult();
        } catch (NoResultException $e) {
            throw new CategoryNotFoundException('Category not found');
        }
    }

    /**
     * @return Category[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository(Category::class)->findAll();
    }
}
