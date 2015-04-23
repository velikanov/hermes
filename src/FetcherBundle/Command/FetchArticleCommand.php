<?php

namespace FetcherBundle\Command;

use FetcherBundle\Form\DataTransformer\RssArticleToArticleTransformer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchArticleCommand extends ContainerAwareCommand {
    protected function configure()
    {
        $this->setName('fetch:article');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $feedReader = $container->get('debril.reader');

        $entityManager = $container->get('doctrine')->getManager();

        $articleRepository = $entityManager->getRepository('AppBundle:Article\Article');
        $rssTemplateFieldRepository = $entityManager->getRepository('AppBundle:RssTemplateField');

        $dataSources = $entityManager->getRepository('AppBundle:DataSource')->findAll();

        $counters = [
            'added' => 0,
            'skipped' => 0,
        ];

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

                    $counters['added']++;
                } else {
                    $counters['skipped']++;
                }
            }
        }

        $output->writeln(sprintf('Added <info>%d</info> articles', $counters['added']));
        $output->writeln(sprintf('Skipped <info>%d</info> articles', $counters['skipped']));
    }
} 