<?php

namespace FetcherBundle\Command;

use AppBundle\Entity\Article;
use Buzz\Message\Request;
use Buzz\Message\Response;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchArticleContentCommand extends ContainerAwareCommand {
    protected function configure()
    {
        $this->setName('fetcher:fetch:content');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $doctrine = $container->get('doctrine');

        /** @var EntityManager $entityManager */
        $entityManager = $doctrine->getManager();

        $articleRepository = $entityManager->getRepository('AppBundle:Article');

        $articles = $articleRepository->findBy([
                'content' => null,
            ], [
                'dateTime' => 'DESC',
            ], 100);

        $buzzMulti = $container->get('buzz.multi');

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
                    'callback' => function($client, $request, $response, $options, $error) use ($article, $entityManager, $output, $counters)
                    {
                        /** @var Response $response */

                        if (!$error) {
                            $article->setContent($response->getContent());

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