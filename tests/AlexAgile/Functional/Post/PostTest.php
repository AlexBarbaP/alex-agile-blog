<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Functional\Homepage;

use AlexAgile\Tests\DoctrineAwareTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostTest extends WebTestCase
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

        $client->request('GET', '/post/post-one-url-slug');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Post one title', $client->getResponse()->getContent());
        $this->assertContains('Post One Content', $client->getResponse()->getContent());

        $this->assertContains('category-title', $client->getResponse()->getContent());

        $this->assertNotContains('Post One Description', $client->getResponse()->getContent());
    }
}
