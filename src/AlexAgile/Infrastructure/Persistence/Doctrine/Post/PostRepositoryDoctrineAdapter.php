<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\Doctrine\Post;

use AlexAgile\Domain\Post\PostId;
use AlexAgile\Domain\Post\PostRepositoryInterface;
use AlexAgile\Domain\ValueObject\UrlSlug;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use AlexAgile\Domain\Post\Post;
use Doctrine\ORM\EntityRepository;

final class PostRepositoryDoctrineAdapter implements PostRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(PostId $postId):? Post
    {
        $queryBuilder = $this->em->createQueryBuilder(); getRepository(Post::class);
        $query = $queryBuilder->select('p, c')
            ->from('Post', 'p')
            ->join('p.categories', 'c')
            ->where('p.postId = :postId')
            ->setParameter('postId', $postId)
            ->getQuery();

        return $query->execute();
        //return $this->em->getRepository(Post::class)->find($postId);
    }

    public function findByUrlSlug(UrlSlug $urlSlug):? Post
    {
        return $this->em->getRepository(Post::class)->findOneBy(['urlSlug' => $urlSlug]);
    }

    /**
     * @return Post[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository(Post::class)->findAll();
    }
}
