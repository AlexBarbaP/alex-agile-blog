<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\About;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about-me", methods={"GET", "POST"}, name="about")
     * @Template("About/Template/About.html.twig")
     */
    public function __invoke(Request $request): array
    {
        return [];
    }
}
