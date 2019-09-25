<?php
declare(strict_types=1);

namespace AlexAgile\Application\Category;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Category\GetCategoriesCommand;
use AlexAgile\Domain\Category\GetCategoriesService;

class GetCategoriesCommandHandler
{
    /** @var GetCategoriesService */
    private $getCategoriesService;

    public function __construct(GetCategoriesService $getCategoriesService)
    {
        $this->getCategoriesService = $getCategoriesService;
    }

    /**
     * @return Category[]
     */
    public function handle(GetCategoriesCommand $command): array
    {
        return $this->getCategoriesService->execute();
    }
}
