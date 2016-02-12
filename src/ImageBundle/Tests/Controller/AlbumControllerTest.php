<?php

namespace ImageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DefaultControllerTest
 * @package ImageBundle\Tests\Controller
 */
class AlbumControllerTest extends WebTestCase
{
    /**
     * Test list albums action.
     */
    public function testList()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals(200, $statusCode);
    }

    /**
     * Test items action.
     */
    public function testItems()
    {
        $client = static::createClient();
        $client->request('GET', '/album/148/page');
        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals(200, $statusCode);
    }

    /**
     * Test ajax items action.
     */
    public function testAjaxItems()
    {
        $client = static::createClient();
        $client->request('GET', '/ajax/album/148/page');
        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals(200, $statusCode);
    }
}
