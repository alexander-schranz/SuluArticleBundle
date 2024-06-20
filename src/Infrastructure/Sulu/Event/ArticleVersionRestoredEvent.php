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

use Sulu\Bundle\ActivityBundle\Domain\Event\DomainEvent;
use Sulu\Bundle\ArticleBundle\Admin\ArticleAdmin;
use Sulu\Article\Domain\Model\Article;
use Sulu\Component\Content\Document\Behavior\SecurityBehavior;
use Sulu\Article\Domain\Model\ArticleInterface;

class ArticleVersionRestoredEvent extends DomainEvent
{
    /**
     * @var Article
     */
    private $article;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $version;

    public function __construct(
        Article $article,
        string $locale,
        string $version
    ) {
        parent::__construct();

        $this->article = $article;
        $this->locale = $locale;
        $this->version = $version;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function getEventType(): string
    {
        return 'version_restored';
    }

    public function getEventContext(): array
    {
        return [
            'version' => $this->version,
        ];
    }

    public function getResourceKey(): string
    {
        return ArticleInterface::RESOURCE_KEY;
    }

    public function getResourceId(): string
    {
        return $this->articleDocument->getUuid();
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

    public function getResourceSecurityObjectType(): ?string
    {
        return SecurityBehavior::class;
    }
}
