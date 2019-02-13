<?php
declare(strict_types=1);

namespace Growonic\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Stopwatch\Stopwatch;

class TestingTest extends TestCase
{
    public function testSomething()
    {
        $stopwatch = new Stopwatch();

        $stopwatch->start('event_name');
        sleep(10);
        $duration = $stopwatch->stop('event_name')->getDuration();

        $this->assertEquals(10000, $duration);
    }
}
