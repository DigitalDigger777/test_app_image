<?php

namespace ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ImageController
 * @package ImageBundle\Controller
 */
class ImageController extends Controller
{
    /**
     * Item action.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function itemAction()
    {
        return $this->render('ImageBundle:Default:index.html.twig');
    }
}
