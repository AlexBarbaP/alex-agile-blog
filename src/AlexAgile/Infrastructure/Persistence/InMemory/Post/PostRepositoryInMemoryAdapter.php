<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\InMemory\Post;

use AlexAgile\Domain\Post\Post;
use AlexAgile\Domain\Post\PostId;
use AlexAgile\Domain\Post\PostRepositoryInterface;
use AlexAgile\Domain\ValueObject\UrlSlug;

final class PostRepositoryInMemoryAdapter implements PostRepositoryInterface
{
    /** @var array */
    private $data = [];

    public function __construct(array $data = [])
    {
        $this->data = array_reduce($data, function ($carry, Post $post) {
            $carry[$post->getId()->id()] = clone $post;

            return $carry;
        }, []);
    }

    public function find(PostId $postId):? Post
    {
        if (!array_key_exists($postId->id(), $this->data)) {
            return null;
        }

        return clone $this->data[$postId->id()];
    }

    public function findByUrlSlug(UrlSlug $urlSlug):? Post
    {
        /** @var Post $post */
        foreach ($this->data as $post) {
            if ($post->getUrlSlug()->urlSlug() == $urlSlug->urlSlug()) {
                return clone $post;
            }
        }

        return null;
    }

    public function findAll(): array
    {
        return array_map(function (Post $post) {
            return clone $post;
        }, $this->data);
    }
}
