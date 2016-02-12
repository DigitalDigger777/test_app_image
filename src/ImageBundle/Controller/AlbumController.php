<?php

namespace ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

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
    public function indexAction()
    {
        return $this->render('ImageBundle:Album:index.html.twig');
    }

    /**
     * Ajax albums list action.
     *
     * @return JsonResponse
     */
    public function ajaxListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('ImageBundle:Album')->getAlbumList();

        return new JsonResponse($albums);
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
        /**
         * @var \ImageBundle\Entity\Image $image
         */
        $this->loadItems($id, $page);

        $images = [];

        foreach($this->pagination as $image) {
            array_push($images, [
                'id'    => $image->getId(),
                'file'  => $image->getFile(),
                'title' => $image->getTitle()
            ]);
        }

        return new JsonResponse($images);
    }

    /**
     * Render pagination
     *
     * @param $id
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paginationAction($id, $page)
    {
        $this->loadItems($id, $page);

        return $this->render('ImageBundle:Album:_pagination.html.twig', [
            'pagination' => $this->pagination
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
        $em        = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $albumRepo = $em->getRepository('\ImageBundle\Entity\Album');
        $albumRepo->setPaginator($paginator);

        $this->album      = $albumRepo->find($id);
        $this->pagination = $albumRepo->getItems($this->album, $page);
    }
}
