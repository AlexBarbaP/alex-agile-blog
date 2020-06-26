<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Home;

use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public const HOMEPAGE_ROUTE_NAME = 'home';

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/", methods={"GET", "POST"}, name="home")
     * @Template("Home/Home.html.twig")
     */
    public function __invoke(Request $request): array
    {
        return [
            'homelink' => '',
        ];
    }
}
