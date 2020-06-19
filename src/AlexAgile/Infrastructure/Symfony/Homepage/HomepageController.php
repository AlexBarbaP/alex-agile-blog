<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Homepage;

use AlexAgile\Domain\Post\GetHomepagePostsCommand;
use AlexAgile\Domain\Post\Post;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
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
     * @Route("/home", methods={"GET", "POST"}, name="home")
     * @Template("Homepage/Homepage.html.twig")
     */
    public function __invoke(Request $request): array
    {
        $getHomepagePostsCommand = new GetHomepagePostsCommand();

        /** @var Post[] $post */
        $postsArray = $this->commandBus->handle($getHomepagePostsCommand);

        return [
            'posts' => $postsArray,
        ];
    }
}
