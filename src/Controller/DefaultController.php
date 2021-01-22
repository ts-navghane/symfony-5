<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return new Response('Test Default Controller With Annotations');
    }

    /**
     * @Route("/default/test-this-new-route")
     */
    public function show(): Response
    {
        return new Response('Test New Route With Annotations');
    }

    /**
     * @Route("/default/{slug}")
     */
    public function showSlug(string $slug): Response
    {
        $testForLoop = [
            'ABC',
            'PQR',
            'XYZ',
        ];

        return $this->render(
            'default/show.html.twig',
            [
                'slug' => ucwords(str_replace('-', ' ', $slug)),
                'testForLoop' => $testForLoop
            ]
        );
    }
}
