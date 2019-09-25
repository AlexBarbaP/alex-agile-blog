<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\Post;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Post\Post;
use AlexAgile\Domain\Post\PostId;
use AlexAgile\Domain\Post\PostNotFoundException;
use AlexAgile\Domain\Post\PostRepositoryInterface;
use AlexAgile\Domain\ValueObject\UrlSlug;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;

final class PostRepositoryDoctrineAdapter implements PostRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @throws PostNotFoundException
     */
    public function find(PostId $postId): ?Post
    {
        try {
            $query = $this->em->createQueryBuilder()
                ->select('p, c')
                ->from('AlexAgile\Domain\Post\Post', 'p')
                ->join('p.categories', 'c')
                ->where('p.postId = :postId')
                ->setParameter('postId', $postId)
                ->getQuery();

            return $query->execute();
        } catch (NoResultException $e) {
            throw new PostNotFoundException('Post not found');
        }
    }

    /**
     * @throws PostNotFoundException
     */
    public function findByUrlSlug(UrlSlug $urlSlug): ?Post
    {
        try {
            $queryBuilder = $this->em->createQueryBuilder();
            $query = $queryBuilder->select('p, c')
                ->from('AlexAgile\Domain\Post\Post', 'p')
                ->join('p.categories', 'c')
                ->where('p.urlSlug = :urlSlug')
                ->setParameter('urlSlug', $urlSlug->urlSlug())
                ->getQuery();

            return $query->getSingleResult();
        } catch (NoResultException $e) {
            throw new PostNotFoundException('Post not found');
        }
    }

    /**
     * @return Post[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository(Post::class)->findAll();
    }

    /**
     * @return Post[]
     */
    public function findAllEnabledOrderedByOrder(): array
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->select('p, c')
            ->from('AlexAgile\Domain\Post\Post', 'p')
            ->join('p.categories', 'c')
            ->where('p.enabled = :enabled')
            ->setParameter('enabled', true)
            ->orderBy('p.order', 'DESC')
            ->getQuery();

        return $query->execute();
    }

    /**
     * @return Post[]
     */
    public function findAllEnabledByCategoryOrderedByOrder(Category $category): array
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $query = $queryBuilder->select('p, c')
            ->from('AlexAgile\Domain\Post\Post', 'p')
            ->join('p.categories', 'c')
            ->where('c.id = :categoryId')
            ->setParameter('categoryId', $category->getId())
            ->orderBy('p.order', 'DESC')
            ->getQuery();

        return $query->execute();
    }
}
