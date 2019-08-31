<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Menu;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends AbstractController
{
    /**
     * @Template("Menu/menu.html.twig")
     */
    public function __invoke(Request $request): array
    {
        return [];
    }
}
