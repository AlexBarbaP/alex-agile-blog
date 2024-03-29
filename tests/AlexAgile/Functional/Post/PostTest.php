<?php
declare(strict_types=1);

namespace AlexAgile\Tests\Functional\Post;

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
    public function postPage_shouldShowPostDetailPage()
    {
        $client = static::createClient();

        $client->request('GET', '/post/post-one-url-slug');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('Post one title', $client->getResponse()->getContent());
        $this->assertStringContainsString('Post One Content', $client->getResponse()->getContent());

        $this->assertStringContainsString('category-title', $client->getResponse()->getContent());

        $this->assertStringNotContainsString('Post One Description', $client->getResponse()->getContent());
    }
}
