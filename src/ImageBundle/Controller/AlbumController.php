<?php

namespace ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('ImageBundle:Album')->findAll();

        return $this->render('ImageBundle:Album:index.html.twig', [
            'albums' => $albums
        ]);
    }

    /**
     * @param $id
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function itemsAction($id, $page)
    {
        $this->loadItems($id, $page);

        return $this->render('ImageBundle:Album:items.html.twig', [
            'album'      => $this->album,
            'pagination' => $this->pagination
        ]);
    }

    public function ajaxItemsAction($id, $page)
    {
        $this->loadItems($id, $page);

        return $this->render('ImageBundle:Album:_ajax_items.html.twig', [
            'album'      => $this->album,
            'pagination' => $this->pagination
        ]);
    }

    private function loadItems($id, $page)
    {
        /**
         * @type \ImageBundle\Repository\AlbumRepository $albumRepo
         * @type \ImageBundle\Entity\Album $album
         */
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $albumRepo = $em->getRepository('\ImageBundle\Entity\Album');
        $albumRepo->setPaginator($paginator);

        $this->album      = $albumRepo->find($id);
        $this->pagination = $albumRepo->getItems($this->album, $page);
    }
}
