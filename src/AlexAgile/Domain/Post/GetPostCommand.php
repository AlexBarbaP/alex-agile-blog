<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Post;

class GetPostCommand
{
    /** @var string */
    private $urlSlug;

    public function __construct(string $urlSlug)
    {
        $this->urlSlug = $urlSlug;
    }

    public function urlSlug(): string
    {
        return $this->urlSlug;
    }
}
