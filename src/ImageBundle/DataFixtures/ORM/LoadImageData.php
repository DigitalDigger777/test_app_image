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
use ImageBundle\Entity\Image;

/**
 * Class LoadImageData
 * @package ImageBundle\DataFixtures\ORM
 */
class LoadImageData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /*
         * @type \ImageBundle\Entity\Album $album
         */
        $this->prepareFiles();
        for ($i = 1; $i <= 5; ++$i) {
            $album = $this->getReference('album-'.$i);

            if ($i === 1) {
                for ($n = 1; $n <= 5; ++$n) {
                    $file = $this->getRandomImage();

                    $image = new Image();
                    $image->setAlbum($album);
                    $image->setTitle('Image #'.$n);
                    $image->setFile($file);

                    $manager->persist($image);
                    $manager->flush();
                }
            } else {
                $countImages = rand(20, 100);

                for ($n = 1; $n <= $countImages; ++$n) {
                    $file = $this->getRandomImage();

                    $image = new Image();
                    $image->setAlbum($album);
                    $image->setTitle('Image #'.($n + 5));
                    $image->setFile($file);

                    $manager->persist($image);
                    $manager->flush();
                }
            }
        }
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }

    /**
     * Prepare test images.
     *
     * @return void
     */
    private function prepareFiles()
    {
        $pathToImages = __DIR__.'/images';
        $publicPathToImages = __DIR__.'/../../../../web/uploads';

        if (!file_exists($publicPathToImages)) {
            mkdir($publicPathToImages);
            chmod($publicPathToImages, 0766);
        } else {
            $publicIterator = new \DirectoryIterator($publicPathToImages);

            foreach ($publicIterator as $item) {
                if ($item->isFile()) {
                    unlink($item->getPathname());
                }
            }
        }

        $iterator = new \DirectoryIterator($pathToImages);

        foreach ($iterator as $item) {
            if ($item->isFile() && $item->getExtension() == 'jpg') {
                copy($item->getRealPath(), $publicPathToImages.'/'.$item->getFilename());
            }
        }
    }

    /**
     * Get random image.
     *
     * @return mixed
     */
    private function getRandomImage()
    {
        $pathToImages = __DIR__.'/../../../../web/uploads';
        $images = array_diff(scandir($pathToImages), ['..', '.']);
        $images = array_values($images);

        $index = rand(0, count($images) - 1);

        return $images[$index];
    }
}
