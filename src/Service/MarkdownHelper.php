<?php

declare(strict_types=1);

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    /**
     * @var MarkdownParserInterface
     */
    private $markdownParser;

    /**
     * @var CacheInterface
     */
    private $cache;

    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function parse(string $source): string
    {
        return $this->cache->get(
            'markdown_'.md5($source),
            function () use ($source) {
                return $this->markdownParser->transformMarkdown($source);
            }
        );
    }
}
