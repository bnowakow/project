<?php

namespace MasterPoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{

    public function indexAction()
    {

//
//        return $this->render(':profile:index.html.twig', [
//            'form' => $form->createView(),
//        ]);
    }

    public function setupAction()
    {

        return $this->render(':profile:setup.html.twig');
    }

}
