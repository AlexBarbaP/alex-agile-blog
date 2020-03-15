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
        
        $content = $client->getResponse()->getContent();
        $this->assertStringContainsString('Post one title', $content);
        $this->assertStringContainsString('Post One Content', $content);

        $this->assertStringContainsString('category-title', $content);
        $this->assertStringContainsString('/category', $content);

        $this->assertStringNotContainsString('Post One Description', $content);
        $this->assertStringNotContainsString('post/post-one-url-slug', $content);
        $this->assertStringNotContainsString('Post two title', $content);
    }
}
