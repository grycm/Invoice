<?php

namespace InvoiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends Controller
{

    /**
     * @Route("/new")
     * @Method("GET")
     * @Template
     */
    public function newAction()
    {

    }

    /**
     * @Route("/new")
     * @Method("POST")
     * @Template("InvoiceBundle:Invoice:new.html.twig")
     */
    public function generateAction(Request $request)
    {
        $post = $request->request;

        dump($post);
    }
}
