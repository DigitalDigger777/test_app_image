<?php

namespace ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class AlbumController
 * @package ImageBundle\Controller
 */
class AlbumController extends Controller
{
    /**
     * @var \ImageBundle\Entity\Album
     */
    public $album;

    /**
     * @var \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public $pagination;

    /**
     * List action.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('ImageBundle:Album')->findAll();

        return $this->render('ImageBundle:Album:index.html.twig', [
            'albums' => $albums,
        ]);
    }

    /**
     * Items action.
     *
     * @param int $id   Item id.
     * @param int $page Page number.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function itemsAction($id, $page)
    {
        $this->loadItems($id, $page);

        return $this->render('ImageBundle:Album:items.html.twig', [
            'album' => $this->album,
            'pagination' => $this->pagination,
        ]);
    }

    /**
     * Ajax items action.
     *
     * @param int $id   Item id.
     * @param int $page Page number.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajaxItemsAction($id, $page)
    {
        $this->loadItems($id, $page);

        return $this->render('ImageBundle:Album:_ajax_items.html.twig', [
            'album' => $this->album,
            'pagination' => $this->pagination,
        ]);
    }

    /**
     * Load items.
     *
     * @param $id
     * @param $page
     */
    private function loadItems($id, $page)
    {
        /*
         * @var \ImageBundle\Repository\AlbumRepository $albumRepo
         * @var \ImageBundle\Entity\Album $album
         */
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $albumRepo = $em->getRepository('\ImageBundle\Entity\Album');
        $albumRepo->setPaginator($paginator);

        $this->album = $albumRepo->find($id);
        $this->pagination = $albumRepo->getItems($this->album, $page);
    }
}
