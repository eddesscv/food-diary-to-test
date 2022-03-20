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

    public function testHomepage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(1, $crawler->filter('html:contains("Bienvenue sur FoodDiary !")')->count());
        /* $this->assertSame(1, $crawler->filter('h1')->count()); */
    }

    public function testAddRecord()
    {
        $client = static::createClient();

        /* $crawler = $client->request('GET', '/diary/add-new-record'); */

        $crawler = $client->request('GET', '/');

        $link = $crawler->selectLink('Voir tous les rapports')->link();
        $crawler = $client->click($link);

        $form = $crawler->selectButton('Ajouter')->form();
        $form['food[username]'] = 'John Doe';
        $form['food[entitled]'] = 'Plat de pâtes';
        $form['food[calories]'] = 600;
        $crawler = $client->submit($form);

        /* $client->followRedirect();

        echo $client->getResponse()->getContent(); */

        /* $crawler = $client->followRedirect(); */ // Attention à bien récupérer le crawler mis à jour

        /* $this->assertSame(1, $crawler->filter('div.alert.alert-success')->count());
 */
        $link = $crawler->selectLink('Voir tous les rapports')->link();
        $crawler = $client->click($link);

        $info = $crawler->filter('h1')->text();
        $info = $string = trim(preg_replace('/\s\s+/', ' ', $info)); // On retire les retours à la ligne pour faciliter la vérification

        $this->assertSame("Tous les rapports Tout ce qui a été mangé !", $info);
    }
}
