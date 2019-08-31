<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Homepage;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", methods={"GET", "POST"}, name="home")
     * @Template("Homepage/homepage.html.twig")
     */
    public function __invoke(Request $request): array
    {
        return [];
    }
}
