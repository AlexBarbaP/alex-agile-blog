<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\OneOnOneCoaching;

use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OneOnOneCoachingController extends AbstractController
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
     * @Route("/one-on-one-coaching", methods={"GET", "POST"}, name="one-on-one-coaching")
     * @Template("OneOnOneCoaching/OneOnOneCoaching.html.twig")
     */
    public function __invoke(Request $request): array
    {
        return [
            'homelink' => '',
        ];
    }
}
