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
        $this->assertContains('Post one title', $content);
        $this->assertContains('Post One Description', $content);
        $this->assertContains('post/post-one-url-slug', $content);

        $this->assertContains('category-title', $content);
        $this->assertContains('/category', $content);

        $this->assertNotContains('Post One Content', $content);
        $this->assertNotContains('Post two title', $content);
    }
}
