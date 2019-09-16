<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Integration\Fixture\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AlexAgile\Domain\User\User;
use AlexAgile\Domain\ValueObject\Email;
use AlexAgile\Domain\ValueObject\Password;

class DoctrineUserFixtureLoader extends Fixture
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
