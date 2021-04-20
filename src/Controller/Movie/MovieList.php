<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use Symfony\Component\HttpFoundation\Response;

final class MovieList
{
    public function __invoke(): Response
    {
        return new Response(<<<'HTML'
<h1>Mes films</h1>

<ul>
<li>Mon livre 1</li>
<li>Mon livre 2</li>
</ul>
HTML
        );
    }
}
