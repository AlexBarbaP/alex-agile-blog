<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Category;

use AlexAgile\Domain\Post\GetPostsByCategoryCommand;
use AlexAgile\Domain\Post\Post;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
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
     * @Route("/{categoryName}", methods={"GET", "POST"}, name="category")
     * @Template("Category/Category.html.twig")
     */
    public function __invoke(Request $request, string $categoryName): array
    {
        $getPostsByCategoryCommand = new GetPostsByCategoryCommand($categoryName);

        /** @var Post[] $post */
        $postsArray = $this->commandBus->handle($getPostsByCategoryCommand);

        return [
            'posts' => $postsArray,
        ];
    }
}