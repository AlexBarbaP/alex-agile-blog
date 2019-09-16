<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Category;

use AlexAgile\Domain\ValueObject\Color;
use AlexAgile\Domain\ValueObject\Title;
use AlexAgile\Domain\ValueObject\UrlSlug;

class Category
{
    /** @var CategoryId */
    private $id;

    /** @var Color */
    private $color;

    /** @var \DateTimeImmutable */
    private $created;

    /** @var \DateTimeImmutable */
    private $modified;

    /** @var Title */
    private $title;

    /** @var UrlSlug */
    private $urlSlug;

    public function __construct(
        Color $color,
        Title $title,
        UrlSlug $urlSlug,
        CategoryId $categoryId = null,
        \DateTimeImmutable $created = null,
        \DateTimeImmutable $modified = null
    ) {
        $this->id= $categoryId ?: CategoryId::create();
        $this->color = $color;
        $this->title = $title;
        $this->urlSlug = $urlSlug;
        $this->created = $created ?: new \DateTimeImmutable();
        $this->modified = $modified ?: new \DateTimeImmutable();
    }

    public function getId(): CategoryId
    {
        return $this->id;
    }

    public function getColor(): Color
    {
        return $this->color;
    }

    public function getCreated(): \DateTimeImmutable
    {
        return $this->created;
    }

    public function getModified(): \DateTimeImmutable
    {
        return $this->modified;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getUrlSlug(): UrlSlug
    {
        return $this->urlSlug;
    }
}
