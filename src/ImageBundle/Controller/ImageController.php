<?php

namespace ImageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ImageController extends Controller
{
    public function itemAction()
    {
        return $this->render('ImageBundle:Default:index.html.twig');
    }
}
