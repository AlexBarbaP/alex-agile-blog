<?php
declare(strict_types=1);

namespace Growonic\Tests\Integration\Fixture\User;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Growonic\Domain\User\User;
use Growonic\Domain\ValueObject\Email;
use Growonic\Domain\ValueObject\Password;

class DoctrineUserFixtureLoader implements FixtureInterface
{
    private const VALID_EMAIL = 'valid@email.com';
    private const VALID_PASSWORD = 'password-long-enough';

    /**
     * @inheritdoc
     */
    public function load(ObjectManager $manager)
    {
        $user = new User(Email::create(self::VALID_EMAIL), Password::create(self::VALID_PASSWORD));

        $manager->persist($user);
        $manager->flush();
    }
}
