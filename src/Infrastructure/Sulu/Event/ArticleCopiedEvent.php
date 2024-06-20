<?php

/*
 * This file is part of Sulu.
 *
 * (c) Sulu GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Article\Infrastructure\Sulu\Event;

use Sulu\Article\Domain\Model\ArticleInterface;
use Sulu\Bundle\ActivityBundle\Domain\Event\DomainEvent;
use Sulu\Bundle\ArticleBundle\Admin\ArticleAdmin;
use Sulu\Article\Domain\Model\Article;

class ArticleCopiedEvent extends DomainEvent
{
    /**
     * @var Article
     */
    private $article;

    /**
     * @var string
     */
    private $sourceArticleId;

    /**
     * @var string|null
     */
    private $sourceArticleTitle;

    /**
     * @var string|null
     */
    private $sourceArticleTitleLocale;

    public function __construct(
        Article $article,
        string $sourceArticleId,
        ?string $sourceArticleTitle,
        ?string $sourceArticleTitleLocale
    ) {
        parent::__construct();

        $this->article = $article;
        $this->sourceArticleId = $sourceArticleId;
        $this->sourceArticleTitle = $sourceArticleTitle;
        $this->sourceArticleTitleLocale = $sourceArticleTitleLocale;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getEventType(): string
    {
        return 'copied';
    }

    public function getEventContext(): array
    {
        return [
            'sourceArticleId' => $this->sourceArticleId,
            'sourceArticleTitle' => $this->sourceArticleTitle,
            'sourceArticleTitleLocale' => $this->sourceArticleTitleLocale,
        ];
    }

    public function getResourceKey(): string
    {
        return ArticleInterface::RESOURCE_KEY;
    }

    public function getResourceId(): string
    {
        return (string) $this->article->getUuid();
    }

    public function getResourceTitle(): ?string
    {
        return $this->article->getTitle();
    }

    public function getResourceTitleLocale(): ?string
    {
        return $this->article->getLocale();
    }

    public function getResourceSecurityContext(): ?string
    {
        return ArticleAdmin::SECURITY_CONTEXT;
    }
}
