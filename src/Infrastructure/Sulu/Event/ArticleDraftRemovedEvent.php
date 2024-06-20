<?php

declare(strict_types=1);

/*
 * This file is part of Sulu.
 *
 * (c) Sulu GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ArticleBundle\Domain\Event;

use Sulu\Article\Domain\Model\ArticleInterface;
use Sulu\Bundle\ActivityBundle\Domain\Event\DomainEvent;
use Sulu\Bundle\ArticleBundle\Admin\ArticleAdmin;
use Sulu\Article\Domain\Model\Article;

class ArticleDraftRemovedEvent extends DomainEvent
{
    /**
     * @var Article
     */
    private $article;

    /**
     * @var string
     */
    private $locale;

    public function __construct(
        Article $article,
        string $locale
    ) {
        parent::__construct();

        $this->article = $article;
        $this->locale = $locale;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getEventType(): string
    {
        return 'draft_removed';
    }

    public function getResourceKey(): string
    {
        return ArticleInterface::RESOURCE_KEY;
    }

    public function getResourceId(): string
    {
        return (string) $this->articleDocument->getUuid();
    }

    public function getResourceLocale(): ?string
    {
        return $this->locale;
    }

    public function getResourceTitle(): ?string
    {
        return $this->articleDocument->getTitle();
    }

    public function getResourceTitleLocale(): ?string
    {
        return $this->articleDocument->getLocale();
    }

    public function getResourceSecurityContext(): ?string
    {
        return ArticleAdmin::SECURITY_CONTEXT;
    }
}
