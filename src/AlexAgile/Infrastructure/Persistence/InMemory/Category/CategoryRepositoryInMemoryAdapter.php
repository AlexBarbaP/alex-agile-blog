<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Persistence\InMemory\Category;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Category\CategoryId;
use AlexAgile\Domain\Category\CategoryRepositoryInterface;
use AlexAgile\Domain\ValueObject\UrlSlug;

final class CategoryRepositoryInMemoryAdapter implements CategoryRepositoryInterface
{
    /** @var array */
    private $data = [];

    public function __construct(array $data = [])
    {
        $this->data = array_reduce($data, function ($carry, Category $category) {
            $carry[$category->getId()->id()] = clone $category;

            return $carry;
        }, []);
    }

    public function find(CategoryId $categoryId): ?Category
    {
        if (!array_key_exists($categoryId->id(), $this->data)) {
            return null;
        }

        return clone $this->data[$categoryId->id()];
    }

    public function findByUrlSlug(UrlSlug $urlSlug): ?Category
    {
        /** @var Category $category */
        foreach ($this->data as $category) {
            if ($category->getUrlSlug()->urlSlug() == $urlSlug->urlSlug()) {
                return clone $category;
            }
        }

        return null;
    }

    public function findAll(): array
    {
        return array_map(function (Category $category) {
            return clone $category;
        }, $this->data);
    }
}
