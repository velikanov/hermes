<?php

namespace FetcherBundle\Form\DataTransformer;

use AppBundle\Entity\Article;
use AppBundle\Entity\DataSource;
use AppBundle\Entity\RssTemplateField;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\DataTransformerInterface;

class RssArticleToArticleTransformer implements DataTransformerInterface {
    private $rssTemplateFieldRepository;
    private $dataSource;

    private $rssTemplateFields;

    public function __construct(EntityRepository $rssTemplateFieldRepository, DataSource $dataSource)
    {
        $this->rssTemplateFieldRepository = $rssTemplateFieldRepository;
        $this->dataSource = $dataSource;

        $rssTemplate = $dataSource->getRssTemplate();
        if (null === $rssTemplate) {
            $rssTemplate = $dataSource->getDataProvider()->getRssTemplate();
        }

        $this->rssTemplateFields = $rssTemplateFieldRepository->findBy([
                'rssTemplate' => $rssTemplate,
            ]);
    }

    /**
     * @param mixed $rssArticle
     * @return Article
     */
    public function transform($rssArticle)
    {
        $article = new Article();

        $article->setDataSource($this->dataSource);

        /** @var RssTemplateField $rssTemplateField */
        foreach ($this->rssTemplateFields as $rssTemplateField) {
            $setter = 'set'.ucfirst($rssTemplateField->getRssArticleField());
            $getter = 'get'.ucfirst($rssTemplateField->getValue());

            $fieldValue = $rssArticle->$getter();

            if (is_string($fieldValue)) {
                $fieldValue = strip_tags($fieldValue);
            }

            $article->$setter($fieldValue);
        }

        return $article;
    }

    public function reverseTransform($article)
    {

    }
} 