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

    /**
     * @var bool
     */
    private $isDebug;

    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache, bool $isDebug)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
        $this->isDebug = $isDebug;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function parse(string $source): string
    {
        if ($this->isDebug) {
            return $this->markdownParser->transformMarkdown($source);
        }

        return $this->cache->get(
            'markdown_'.md5($source),
            function () use ($source) {
                return $this->markdownParser->transformMarkdown($source);
            }
        );
    }
}
