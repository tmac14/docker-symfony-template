<?php
declare(strict_types = 1);

namespace App\Controller;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Panther\Client;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route(
     *      path="/",
     *      name="index",
     *  )
     */
    public function __invoke(): Response
    {
        $client = Client::createChromeClient();

        $client->request('GET', 'https://www.dia.es/compra-online/');

        $crawler = $client->waitFor('#nav-submenu-container');

        $crawler->filter('#nav-submenu-container > li > a')->each(function (Crawler $node) {
            dump($node->html());
        });

        $client->quit();

        dd('jee');
    }
}
