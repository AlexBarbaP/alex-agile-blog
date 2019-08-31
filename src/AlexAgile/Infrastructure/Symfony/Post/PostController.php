<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Post;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post/inspiring-your-workflow", methods={"GET", "POST"}, name="post")
     * Route("/post/{postName}", name="post")
     * @Template("Post/Template/Post.html.twig")
     */
    public function __invoke(Request $request): array
    {
        return [];
    }

    /**
     * @Route("/post/agile-to-be-or-not-to-be", methods={"GET", "POST"}, name="post2")
     * @Template("Post/Template/Post2.html.twig")
     */
    public function post2(Request $request): array
    {
        return [];
    }

    /**
     * @Route("/post/the-biggest-enemy-to-hyper-performance-teams-is-you", methods={"GET", "POST"}, name="post3")
     * @Template("Post/Template/Post3.html.twig")
     */
    public function post3(Request $request): array
    {
        return [];
    }
}
