<?php

declare(strict_types=1);

namespace App\Controller\Movie;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movies/{slug}')]
final class MovieDetail
{
    public function __invoke(string $slug): Response
    {
        $slug = htmlspecialchars($slug);
        
        return new Response(<<<HTML
<h1>$slug</h1>
HTML
);
    }
}