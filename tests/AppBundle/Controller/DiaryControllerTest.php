<?php

namespace Tests\AppBundle\Controller;

use Symfony\Component\HTTPFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DiaryControllerTest extends WebTestCase
{
    /* public function testHomepageIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        echo $client->getResponse()->getContent();
    } */

    /* private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testHomepageIsUp()
    {
        $this->client->request('GET', '/');

        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    } */

    public function testHomepageIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode()); // N'oublions pas que nous sommes dans le cadre d'un test ! Il nous faut donc ajouter une assertion. Il faut savoir que la classe Symfony\Bundle\FrameworkBundle\Test\WebTestCase étend la classe PHPUnit PHPUnit_Framework_Test nous permettant d'utiliser les méthodes pour écrire des assertions. 
    }
}