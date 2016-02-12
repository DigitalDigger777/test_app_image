<?php
/**
 * Created by PhpStorm.
 * User: korman
 * Date: 12.02.16
 * Time: 13:31
 */

namespace ImageBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Knp\Component\Pager\Paginator;
use ImageBundle\Repository\AlbumRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class Album
 * @package ImageBundle\Service
 */
class Album
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * @var AlbumRepository
     */
    private $albumRepo;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->em         = $container->get('doctrine')->getManager();
        $this->paginator  = $container->get('knp_paginator');
        $this->albumRepo  = $this->em->getRepository('\ImageBundle\Entity\Album');
    }

    /**
     * Load items.
     *
     * @param int $id   Album id
     * @param int $page Page number
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function loadItems($id, $page)
    {
        /**
         * @var \ImageBundle\Entity\Album $album
         */
        $this->albumRepo->setPaginator($this->paginator);
        $album = $this->loadAlbum($id);

        return $this->albumRepo->getItems($album, $page);
    }

    /**
     * Load album.
     *
     * @param $id
     * @return null|object
     */
    private function loadAlbum($id)
    {
        return $this->em->getRepository('\ImageBundle\Entity\Album')->find($id);
    }
}
