<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/{id}/vote/{direction<up|down>}", methods={"POST"})
     * @throws \Exception
     */
    public function commentVote(int $id, string $direction): JsonResponse
    {
        if ($direction === 'up') {
            $currentVoteCount = random_int(7, 100);
        } else {
            $currentVoteCount = random_int(0, 5);
        }

        return $this->json(['votes' => $currentVoteCount]);
    }
}
