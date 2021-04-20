<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    public function urlProvider(): iterable
    {
        yield ['/book/', 200];
        yield ['/movies', 200];
    }

    /**
     * @dataProvider urlProvider
     */
    public function testUrl(string $url, int $code): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertResponseStatusCodeSame($code);
    }
}
