<?php
/**
 * Created by PhpStorm.
 * User: korman
 * Date: 07.02.16
 * Time: 15:10.
 */
namespace ImageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ImageBundle\Entity\Album;

/**
 * Class LoadAlbumData
 * @package ImageBundle\DataFixtures\ORM
 */
class LoadAlbumData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; ++$i) {
            $album = new Album();
            $album->setName('Album #'.$i);

            $manager->persist($album);
            $manager->flush();

            $this->addReference('album-'.$i, $album);
        }
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
