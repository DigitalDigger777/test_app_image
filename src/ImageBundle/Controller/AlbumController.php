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
     * Albums list action.
     *
     * @return JsonResponse
     */
    public function albumListAction()
    {
        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('ImageBundle:Album')->getAlbumList();

        return new JsonResponse($albums);
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
        /**
         * @var \ImageBundle\Service\Album $albumService
         * @var \ImageBundle\Entity\Image $image
         */
        $albumService = $this->get('image.album');

        $pagination = $albumService->loadItems($id, $page);

        $images = [];

        foreach ($pagination as $image) {
            array_push($images, [
                'id'    => $image->getId(),
                'file'  => $image->getFile(),
                'title' => $image->getTitle(),
            ]);
        }

        return new JsonResponse($images);
    }

    /**
     * Render pagination
     *
     * @param int $id   Album id
     * @param int $page Page number
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paginationAction($id, $page)
    {
        /**
         * @var \ImageBundle\Service\Album $albumService
         */
        $albumService = $this->get('image.album');

        $pagination = $albumService->loadItems($id, $page);

        return $this->render('ImageBundle:Album:_pagination.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
