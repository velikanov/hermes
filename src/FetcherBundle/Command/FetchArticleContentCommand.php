<?php

namespace FetcherBundle\Command;

use AppBundle\Entity\Article\Article;
use Buzz\Message\Request;
use Buzz\Message\Response;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchArticleContentCommand extends ContainerAwareCommand {
    protected function configure()
    {
        $this->setName('fetch:article:content');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        /** @var EntityManager $entityManager */
        $entityManager = $container->get('doctrine')->getManager();

        $articleRepository = $entityManager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findBy([
                'rawContent' => null,
            ], [
                'dateTime' => 'DESC',
            ], 1);

        $buzzMulti = $container->get('buzz.multi');
        $articleContentNormalizer = $container->get('fetcher.article_content_normalizer');

        $counters = [
            'fetched' => 0,
            'skipped' => 0,
        ];

        /** @var Article $article */
        foreach ($articles as $article) {
            $url = parse_url($article->getUrl());

            $urlFullPath = $url['path'].(array_key_exists('query', $url) ? '?'.$url['query'] : '');

            $request = new Request(Request::METHOD_GET, $urlFullPath, $url['host']);
            $response = new Response();
            $buzzMulti->send($request, $response, [
                    'callback' => function($client, $request, $response, $options, $error) use ($article, $entityManager, $output, $counters, $articleContentNormalizer)
                    {
                        /** @var Response $response */

                        if (!$error) {
                            $article->setRawContent($response->getContent());

                            $articleContentNormalizer->normalize($article);

                            $entityManager->persist($article);
                            $entityManager->flush();
                        } else {
                            $output->writeln(sprintf('Article %d error: %d', $article->getId(), $response->getStatusCode()));
                            $output->writeln($response->getContent());
                        }
                    },
                ]);
        }

        $buzzMulti->flush();
    }
}