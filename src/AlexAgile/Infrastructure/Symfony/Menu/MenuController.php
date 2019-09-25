<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Menu;

use AlexAgile\Domain\Category\Category;
use AlexAgile\Domain\Category\GetCategoriesCommand;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends AbstractController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Template("Menu/Menu.html.twig")
     */
    public function __invoke(Request $request): array
    {
        $getCategoriesCommand = new GetCategoriesCommand();

        /** @var Category[] $categoriesArray */
        $categoriesArray = $this->commandBus->handle($getCategoriesCommand);

        return [
            'categories' => $categoriesArray,
        ];
    }
}
