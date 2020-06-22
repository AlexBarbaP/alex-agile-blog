<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\NewDesign\Contact;

use AlexAgile\Domain\ContactRequest\CreateContactRequestCommand;
use AlexAgile\Infrastructure\Symfony\NewDesign\Home\HomeController;
use AlexAgile\Infrastructure\Symfony\Type\CreateContactRequestType;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
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
     * @Route("/contact", methods={"GET", "POST"}, name="contact")
     * @Template("NewDesign/Contact/Contact.html.twig")
     */
    public function __invoke(Request $request)
    {
        $form = $this->createForm(CreateContactRequestType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $formData = $form->getData();

                try {
                    $createContactRequestCommand = new CreateContactRequestCommand(
                        $formData['email'] ?: '',
                        $formData['message'] ?: '',
                        $formData['name'] ?: ''
                    );
                    $this->commandBus->handle($createContactRequestCommand);
                } catch (\Throwable $t) {
                    return new Response("<div class='error-message'>" . $t->getMessage() . "</div>");
                }

                return new Response("<div class='success-message'></div>");
            } else {
                $errorMessage = '';

                foreach ($form->getErrors() as $error) {
                    $errorMessage .= $error->getMessage();
                }

                return new Response("<div class='error-message'>$errorMessage</div>");
            }
        }

        return [
            'homelink' => $this->generateUrl(HomeController::HOMEPAGE_ROUTE_NAME),
            'action' => $request->get('action'),
            'form' => $form->createView(),
            'error' => '',
        ];
    }
}