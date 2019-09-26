<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Functional\Homepage;

use AlexAgile\Tests\DoctrineAwareTestTrait;
use AlexAgile\Tests\Integration\Fixture\Category\DoctrineCategoryFixtureLoader;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryTest extends WebTestCase
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

        $client->request('GET', '/' . DoctrineCategoryFixtureLoader::CATEGORY_1_URL_SLUG);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Post one title', $client->getResponse()->getContent());
        $this->assertContains('Post One Description', $client->getResponse()->getContent());
        $this->assertContains('post/post-one-url-slug', $client->getResponse()->getContent());
        $this->assertNotContains('Post One Content', $client->getResponse()->getContent());

        $this->assertContains('Post two title', $client->getResponse()->getContent());
        $this->assertContains('Post Two Description', $client->getResponse()->getContent());
        $this->assertContains('post/post-two-url-slug', $client->getResponse()->getContent());
        $this->assertNotContains('Post Two Content', $client->getResponse()->getContent());
    }
}
