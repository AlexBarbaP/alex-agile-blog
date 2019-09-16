<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Post;

use AlexAgile\Domain\ValueObject\UrlSlug;

class GetPostService
{
    public const POST_URL_SLUG_KEY = 'url-slug';

    /** @var PostRepositoryInterface */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @throws PostNotFoundException
     */
    public function execute(array $options = []): Post
    {
        /** @var UrlSlug $postSlug */
        $postSlug = $options[self::POST_URL_SLUG_KEY];

        if (!$post = $this->postRepository->findByUrlSlug($postSlug)) {
            throw new PostNotFoundException('Post not found');
        }

        return $post;
    }
}
