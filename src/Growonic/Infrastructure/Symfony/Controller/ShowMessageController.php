<?php
declare(strict_types=1);

namespace Growonic\Infrastructure\Symfony\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowMessageController extends AbstractController
{
    /**
     * @Route("/show-message/{message}", methods={"GET", "POST"}, name="show_message")
     * @Template("show-message.html.twig")
     */
    public function __invoke(string $message)
    {
        return [
            'message' => $message,
        ];
    }
}
