<?php

namespace ImageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class DefaultControllerTest
 * @package ImageBundle\Tests\Controller
 */
class AlbumControllerTest extends WebTestCase
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    private $router;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * Setup.
     */
    protected function setUp()
    {
        self::bootKernel();
        $this->container = self::$kernel->getContainer();
        $this->router    = $this->container->get('router');
        $this->em        = $this->container->get('doctrine')->getManager();
    }

    /**
     * Test list albums action.
     */
    public function testIndex()
    {
        $uri = $this->router->generate('image_album_index');

        $client = static::createClient();
        $client->request('GET', $uri);

        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(200, $statusCode);
    }

    /**
     * Test album list.
     */
    public function testAlbumList()
    {
        $uri = $this->router->generate('image_album_index');

        $client = static::createClient();
        $client->request('GET', $uri);
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(200, $statusCode);
    }

    /**
     * Test items route.
     *
     * @throws \Exception
     */
    public function testItems()
    {
        /**
         * @var \ImageBundle\Entity\Album $album
         */
        $album = $this->em->getRepository('\ImageBundle\Entity\Album')->findOneBy([]);

        if ($album) {
            $id = $album->getId();

            $uri = $this->router->generate('image_album_items_by_page', [
                'id'    => $id,
                'page'  => 1,
            ]);

            $client = static::createClient();
            $client->request('GET', $uri);
            $statusCode = $client->getResponse()->getStatusCode();

            $this->assertEquals(200, $statusCode);
        } else {
            throw new \Exception("Albums table is empty");
        }
    }

    /**
     * Test pagination route.
     *
     * @throws \Exception
     */
    public function testPagination()
    {
        /**
         * @var \ImageBundle\Entity\Album $album
         */
        $album = $this->em->getRepository('\ImageBundle\Entity\Album')->findOneBy([]);

        if ($album) {
            $id = $album->getId();

            $uri = $this->router->generate('image_album_pagination', [
                'id'    => $id,
                'page'  => 1,
            ]);

            $client = static::createClient();
            $client->request('GET', $uri);
            $statusCode = $client->getResponse()->getStatusCode();

            $this->assertEquals(200, $statusCode);
        } else {
            throw new \Exception("Albums table is empty");
        }
    }
}
