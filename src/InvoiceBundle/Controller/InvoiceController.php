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





    /**
     * Export to PDF
     *
     * @Route("/pdf", name="acme_demo_pdf")
     */
    public function pdfAction()
    {
        $html = $this->renderView('InvoiceBundle:Invoice:new.html.twig');

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }
}
