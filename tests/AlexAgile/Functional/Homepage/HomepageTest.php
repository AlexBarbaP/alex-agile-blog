<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Functional\Homepage;

use AlexAgile\Tests\DoctrineAwareTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageTest extends WebTestCase
{
    use DoctrineAwareTestTrait;

    /**
     * @inheritdoc
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpEntityManager();
        $this->fixturesLoader();
    }

    /**
     * @test
     */
    public function homepage_shouldShowHomepage()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Post one title', $client->getResponse()->getContent());
        $this->assertContains('Post One Description', $client->getResponse()->getContent());
        $this->assertContains('post/post-one-url-slug', $client->getResponse()->getContent());

        $this->assertNotContains('Post One Content', $client->getResponse()->getContent());
        $this->assertNotContains('Post two title', $client->getResponse()->getContent());
    }

    ///**
    // * @test
    // */
    //public function registerUser_whenDataIsValid_shouldShowNewUserRegisteredMessage()
    //{
    //    $client = static::createClient();
    //
    //    $crawler = $client->request('GET', '/user');
    //
    //    $form = $crawler->selectButton('register_user[submit]')->form();
    //
    //    $form['register_user[email]']            = self::VALID_EMAIL;
    //    $form['register_user[password][first]']  = self::VALID_PASSWORD;
    //    $form['register_user[password][second]'] = self::VALID_PASSWORD;
    //
    //    $client->submit($form);
    //    $client->followRedirect();
    //
    //    $this->assertEquals(200, $client->getResponse()->getStatusCode());
    //    $this->assertContains('New user registered', $client->getResponse()->getContent());
    //}
}
