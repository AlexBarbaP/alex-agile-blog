<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Post;

class GetPostsByCategoryCommand
{
    /** @var string */
    private $categoryUrlSlug;

    public function __construct(string $categoryUrlSlug)
    {
        $this->categoryUrlSlug = $categoryUrlSlug;
    }

    public function categorUrlSlug(): string
    {
        return $this->categoryUrlSlug;
    }
}
