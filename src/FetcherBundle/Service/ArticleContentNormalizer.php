<?php

namespace FetcherBundle\Service;

use AppBundle\Entity\Article\Article;
use AppBundle\Entity\Article\ContentPart;
use AppBundle\Entity\DataProvider\Rule;
use DOMElement;
use Symfony\Component\DomCrawler\Crawler;

class ArticleContentNormalizer
{
    public function normalize(Article $article)
    {
        $rules = $article->getDataSource()->getDataProvider()->getRules();

        $crawler = new Crawler($article->getRawContent());

        /** @var Rule $rule */
        foreach ($rules as $rule) {
            $elements = $crawler->filter($rule->getContentCssSelector());

            /** @var DOMElement $element */
            foreach ($elements as $element) {
                if (trim($element->textContent)) {
                    $contentPart = new ContentPart();
                    $contentPart->setArticle($article);
                    $contentPart->setDataProviderRule($rule);
                    $contentPart->setContent($element->textContent);

                    $article->addContentPart($contentPart);

                }

            }
        }
    }
} 