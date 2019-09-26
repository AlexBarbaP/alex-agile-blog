<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Post;

use AlexAgile\Domain\ValueObject\Content;
use AlexAgile\Domain\ValueObject\Description;
use AlexAgile\Domain\ValueObject\ImageUrl;
use AlexAgile\Domain\ValueObject\Order;
use AlexAgile\Domain\ValueObject\Title;
use AlexAgile\Domain\ValueObject\UrlSlug;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use InvalidArgumentException;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

class Post
{
    /** @var PostId */
    private $id;

    /** @var Collection */
    private $categories;

    /** @var Content */
    private $content = '';

    /** @var \DateTimeImmutable */
    private $created;

    /** @var Description */
    private $description = '';

    /** @var bool */
    private $enabled;

    /** @var bool */
    private $homepage;

    /** @var ImageUrl */
    private $image;

    /** @var \DateTimeImmutable */
    private $modified;

    /** @var Order */
    private $order;

    /** @var Title */
    private $title;

    /** @var UrlSlug */
    private $urlSlug;

    /**
     * @throws \Exception
     * @throws InvalidUuidStringException
     */
    public function __construct(
        Collection $categories,
        Content $content,
        Description $description,
        bool $enabled,
        bool $homepage,
        ImageUrl $image,
        Order $order,
        Title $title,
        UrlSlug $urlSlug,
        PostId $postId = null,
        \DateTimeImmutable $created = null,
        \DateTimeImmutable $modified = null
    ) {
        if (empty($categories)) {
            throw new InvalidArgumentException('Invalid categories argument');
        }

        $this->id = $postId ?: PostId::create();
        $this->categories = $categories;
        $this->content = $content;
        $this->description = $description;
        $this->enabled = $enabled;
        $this->homepage = $homepage;
        $this->image = $image;
        $this->order = $order;
        $this->title = $title;
        $this->urlSlug = $urlSlug;
        $this->created = $created ?: new \DateTimeImmutable();
        $this->modified = $modified ?: new \DateTimeImmutable();
    }

    public function getId(): PostId
    {
        return $this->id;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    public function getCreated(): \DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($this->created);
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function isHomepage(): bool
    {
        return $this->homepage;
    }

    public function getImage(): ImageUrl
    {
        return $this->image;
    }

    public function getModified(): \DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($this->modified);
    }

    public function getOrder(): Order
    {
        return $this->order;
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
