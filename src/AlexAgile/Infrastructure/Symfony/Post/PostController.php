<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Post;

use AlexAgile\Domain\Post\GetPostCommand;
use AlexAgile\Domain\Post\Post;
use AlexAgile\Domain\Post\PostNotFoundException;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
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
     * @Route("/post/{postName}", name="post")
     * @Template("Post/Post.html.twig")
     */
    public function __invoke(Request $request, string $postName)
    {
        try {
            $getPostCommand = new GetPostCommand($postName);

            /** @var Post $post */
            $post = $this->commandBus->handle($getPostCommand);
            return [
                'post' => $post,
            ];
        } catch (PostNotFoundException $e) {
            throw $this->createNotFoundException('The post does not exist');
        }
    }
}
