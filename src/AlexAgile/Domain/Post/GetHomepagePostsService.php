<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Post;

class GetHomepagePostsService
{
    public const POST_URL_SLUG_KEY = 'url-slug';

    /** @var PostRepositoryInterface */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return Post[]
     */
    public function execute(array $options = []): array
    {
        return $this->postRepository->findAllEnabledOrderedByOrder();
    }
}
