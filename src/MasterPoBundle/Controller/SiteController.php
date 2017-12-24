<?php

namespace MasterPoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SiteController extends Controller
{
    public function indexAction()
    {
        return $this->render(':site:index.html.twig');
    }
}
