<?php

namespace App\Controller;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Twig\Environment;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Environment $environment): Response
    {
//        $html = $environment->render('question/homepage.html.twig');
//
//        return new Response($html);
        return $this->render('question/homepage.html.twig');
    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     * @throws InvalidArgumentException
     */
    public function show(string $slug, MarkdownParserInterface $markdownParser, CacheInterface $cache): Response
    {
        $answers = [
            'Make sure your cat is sitting `purrrfectly` still 🤣',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];

        $questionText = 'I\'ve been turned into a cat, any *thoughts* on how to turn back?
        While I\'m **adorable**, I don\'t really care for cat food.';
        $parsedQuestionText = $cache->get(
            'markdown_'.md5($questionText),
            function () use ($markdownParser, $questionText) {
                return $markdownParser->transformMarkdown($questionText);
            }
        );

        return $this->render(
            'question/show.html.twig',
            [
                'question' => ucwords(str_replace('-', ' ', $slug)),
                'answers' => $answers,
                'questionText' => $parsedQuestionText,
            ]
        );
    }
}
