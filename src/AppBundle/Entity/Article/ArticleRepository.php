<?php

namespace AppBundle\Entity\Article;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function findUntranslated($limit = 0)
    {
        $articlesQueryBuilder = $this->createQueryBuilder('a')
            ->leftJoin('a.translations', 't')
        ;
        $articlesQueryBuilder
            ->where($articlesQueryBuilder->expr()->isNull('t.article'))
        ;

        if (0 < $limit) {
            $articlesQueryBuilder->setMaxResults($limit);
        }

        $articlesQuery = $articlesQueryBuilder->getQuery();

        $articles = $articlesQuery->execute();

        return $articles;
    }
} 