<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;

class BookControllerTest extends PantherTestCase
{
    public function testIndexSuccessful(): void
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/book/');

        $bar = $client->executeScript(<<<JAVASCRIPT
console.log('foo');

return 'bar';
JAVASCRIPT
);

        $this->assertSame('bar', $bar);

        //$this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Books');
    }
}
