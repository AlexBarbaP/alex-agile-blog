<?php
declare(strict_types=1);

namespace AlexAgile\Domain\Category;

class GetCategoriesService
{
    /** @var CategoryRepositoryInterface */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Category[]
     */
    public function execute(array $options = []): array
    {
        return $this->categoryRepository->findAll();
    }
}
