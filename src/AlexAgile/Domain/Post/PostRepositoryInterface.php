<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Post;

use AlexAgile\Domain\ValueObject\UrlSlug;

interface PostRepositoryInterface
{
    public function find(PostId $postId):? Post;

    public function findByUrlSlug(UrlSlug $urlSlug):? Post;

    /** @return Post[] */
    public function findAll(): array;
}
