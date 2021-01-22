<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comment/{id}/vote/{direction<up|down>}", methods={"POST"})
     * @throws \Exception
     */
    public function commentVote(int $id, string $direction, LoggerInterface $logger): JsonResponse
    {
        if ($direction === 'up') {
            $logger->info('Voting up');
            $currentVoteCount = random_int(7, 100);
        } else {
            $logger->info('Voting down');
            $currentVoteCount = random_int(0, 5);
        }

        return $this->json(['votes' => $currentVoteCount]);
    }
}
