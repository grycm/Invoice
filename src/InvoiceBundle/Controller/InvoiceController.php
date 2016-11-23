<?php

namespace InvoiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
}
