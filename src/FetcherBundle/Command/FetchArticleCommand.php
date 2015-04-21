<?php

namespace FetcherBundle\Command;

use FetcherBundle\Form\DataTransformer\RssArticleToArticleTransformer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchArticleCommand extends ContainerAwareCommand {
    protected function configure()
    {
        $this->setName('fetcher:fetch');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $doctrine = $container->get('doctrine');
        $feedReader = $container->get('debril.reader');

        $entityManager = $doctrine->getManager();

        $articleRepository = $entityManager->getRepository('AppBundle:Article');
        $rssTemplateFieldRepository = $entityManager->getRepository('AppBundle:RssTemplateField');

        $dataSources = $entityManager->getRepository('AppBundle:DataSource')->findAll();

        foreach ($dataSources as $dataSource) {
            $dataTransformer = new RssArticleToArticleTransformer($rssTemplateFieldRepository, $dataSource);

            $feed = $feedReader->getFeedContent($dataSource->getUrl());
            $items = $feed->getItems();

            foreach ($items as $item) {
                $article = $dataTransformer->transform($item);

                if (null === $articleRepository->findOneBy([
                        'url' => $article->getUrl(),
                    ])) {
                    $entityManager->persist($article);
                    $entityManager->flush();
                }
            }
        }
    }
} 