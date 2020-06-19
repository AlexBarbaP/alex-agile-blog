<?php
declare(strict_types=1);

namespace AlexAgile\Infrastructure\Symfony\Contact;

use AlexAgile\Domain\ContactRequest\CreateContactRequestCommand;
use AlexAgile\Infrastructure\Symfony\Type\CreateContactRequestType;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/old-contact", methods={"GET", "POST"}, name="old-contact")
     * @Template("Contact/Contact.html.twig")
     */
    public function __invoke(Request $request)
    {
        $form = $this->createForm(CreateContactRequestType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            try {
                $createContactRequestCommand = new CreateContactRequestCommand(
                    $formData['email'] ?: '',
                    $formData['message'] ?: '',
                    $formData['name'] ?: '',
                    $formData['phone'] ?: ''
                );
                $this->commandBus->handle($createContactRequestCommand);
            } catch (\Throwable $t) {
                return [
                    'action' => $request->get('action'),
                    'form' => $form->createView(),
                    'error' => $t->getMessage(),
                ];
            }

            return $this->redirect($this->generateUrl('contact', [
                'action' => 'contact-request-successful',
            ]));
        }

        return [
            'action' => $request->get('action'),
            'form' => $form->createView(),
            'error' => '',
        ];
    }
}
