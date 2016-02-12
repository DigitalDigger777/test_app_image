<?php
/**
 * Created by PhpStorm.
 * User: korman
 * Date: 12.02.16
 * Time: 14:51
 */

namespace ImageBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class AlbumRepositoryTest
 * @package ImageBundle\Tests\Repository
 */
class AlbumRepositoryTest extends KernelTestCase
{
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
        $container = self::$kernel->getContainer();
        $this->em  = $container->get('doctrine')->getManager();
    }

    /**
     * Test count albums
     */
    public function testCountAlbums()
    {
        /**
         * @var \Doctrine\Common\Collections\ArrayCollection $albums
         */
        $albums = $this->em->getRepository('\ImageBundle\Entity\Album')->findAll();

        $this->assertGreaterThan(0, count($albums));
    }
}
