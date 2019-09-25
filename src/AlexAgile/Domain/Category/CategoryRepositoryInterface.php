<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Category;

use AlexAgile\Domain\ValueObject\UrlSlug;

interface CategoryRepositoryInterface
{
    /**
     * @throws CategoryNotFoundException
     */
    public function find(CategoryId $categoryId):? Category;

    /**
     * @throws CategoryNotFoundException
     */
    public function findByUrlSlug(UrlSlug $urlSlug):? Category;

    /** @return Category[] */
    public function findAll(): array;
}
