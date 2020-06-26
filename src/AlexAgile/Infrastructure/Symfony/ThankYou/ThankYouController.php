<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\ThankYou;

use AlexAgile\Infrastructure\Symfony\Home\HomeController;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ThankYouController extends AbstractController
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
     * @Route("/thank-you", methods={"GET", "POST"}, name="thank-you")
     * @Template("ThankYou/ThankYou.html.twig")
     */
    public function __invoke(Request $request)
    {
        return [
            'homelink' => $this->generateUrl(HomeController::HOMEPAGE_ROUTE_NAME),
            'error' => '',
        ];
    }
}
