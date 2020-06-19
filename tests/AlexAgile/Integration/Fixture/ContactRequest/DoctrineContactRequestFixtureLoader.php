<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Fixture\ContactRequest;

use AlexAgile\Domain\ContactRequest\ContactRequest;
use AlexAgile\Domain\ValueObject\Email;
use AlexAgile\Domain\ValueObject\Message;
use AlexAgile\Domain\ValueObject\Name;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DoctrineContactRequestFixtureLoader extends Fixture
{
    public const CONTACT_REQUEST_EMAIL = 'valid@email.com';
    public const CONTACT_REQUEST_MESSAGE = 'This is a message';
    public const CONTACT_REQUEST_NAME = 'Valid Name';

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $contactRequest = new ContactRequest(
            Email::create(self::CONTACT_REQUEST_EMAIL),
            Message::create(self::CONTACT_REQUEST_MESSAGE),
            Name::create(self::CONTACT_REQUEST_NAME)
        );

        $manager->persist($contactRequest);
        $manager->flush();
    }
}
