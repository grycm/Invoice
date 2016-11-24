<?php

namespace InvoiceBundle\Controller;

use InvoiceBundle\Entity\Client;
use InvoiceBundle\Entity\Invoice;
use InvoiceBundle\Entity\Product;
use InvoiceBundle\Entity\Seller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends Controller
{

    /**
     * @Route("/new", name="newInvoice")
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

        dump($request->request);
        $em = $this->getDoctrine()->getManager();

        //get Invoice data
        $invoiceNumber = $request->request->get('invoice_number');
        $generationDate = $request->request->get('generation_date');
        $completionDate = $request->request->get('completion_date');
        $place = $request->request->get('place');
        $comment = $request->request->get('comment');

        //set Invoice data
        $invoice = new Invoice();
        $invoice->setInvoiceNumber($invoiceNumber);
        $invoice->setGenerationDate($generationDate);
        $invoice->setCompletionDate($completionDate);
        $invoice->setPlace($place);
        $invoice->setComment($comment);

        //get Seller Data
        $sellerName = $request->request->get('seller_name');
        $sellerAddress = $request->request->get('seller_address');
        $sellerCity = $request->request->get('seller_city');
        $sellerPostal = $request->request->get('seller_postal');
        $sellerNIP = $request->request->get('seller_NIP');

        //set Seller Data
        $seller = new Seller();
        $seller->setSellerName($sellerName);
        $seller->setSellerAddress($sellerAddress);
        $seller->setSellerCity($sellerCity);
        $seller->setSellerPostal($sellerPostal);
        $seller->setSellerNIP($sellerNIP);

        //get Clinet Data
        $clientName = $request->request->get('client_name');
        $clientAddress = $request->request->get('client_address');
        $clientCity = $request->request->get('client_city');
        $clientPostal = $request->request->get('client_postal');
        $clientNIP = $request->request->get('client_NIP');

        //set Client Data
        $client = new Client();
        $client->setclientName($clientName);
        $client->setclientAddress($clientAddress);
        $client->setclientCity($clientCity);
        $client->setclientPostal($clientPostal);
        $client->setclientNIP($clientNIP);

        //add Invoice, Seller and Clinet
        $em->persist($seller);
        $em->persist($client);
        $invoice->setClient($client);
        $invoice->setSeller($seller);

        foreach ($request->request->get('product') as $product) {
            $pName = $product['product_name'];
            $pQuantity = $product['product_quantity'];
            $pNettoPrice = $product['netto_price'];
            //for safety reasons, I calculate it again on server
            $pNettoValue = $pQuantity * $pNettoPrice;
            $pVat = $product['vat'] / 100;
            $pVatValue = $pNettoValue * $pVat;
            $pBruttoValue = $pNettoValue + $pVatValue;

            $pProduct = new Product();
            $pProduct->setProductName($pName);
            $pProduct->setProductQuantity($pQuantity);
            $pProduct->setNettoPrice($pNettoPrice);
            $pProduct->setNettoValue($pNettoValue);
            $pProduct->setVat($pVat);
            $pProduct->setVatValue($pVatValue);
            $pProduct->setBruttoValue($pBruttoValue);

            $em->persist($pProduct);

            $pProduct->setInvoice($invoice);
        }



        $em->persist($invoice);
        $em->flush();

        return [];
        //return $this->redirectToRoute('newInvoice');
    }


    /**
     * @Route("/show/{id}")
     * @Method("GET")
     * @Template
     */
    public function showInvoiceAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('InvoiceBundle:Invoice');
        $invoice = $repo->find($id);

        return ['invoice' => $invoice];
    }

    /**
     * @Route("/pdf/{id}", name="generatePDF")
     * @Method("GET")
     */

    public function generatePdfAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('InvoiceBundle:Invoice');
        $invoice = $repo->find($id);

        $html = $this->renderView('InvoiceBundle:Invoice:showInvoice.html.twig', ['invoice' => $invoice]);
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

    /**
     * Export to PDF
     *
     * @Route("/pdf", name="acme_demo_pdf")
     */
//    public function pdfAction()
//    {
//        $html = $this->renderView('InvoiceBundle:Invoice:new.html.twig');
//
//        $filename = sprintf('test-%s.pdf', date('Y-m-d'));
//
//        return new Response(
//            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
//            200,
//            [
//                'Content-Type'        => 'application/pdf',
//                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
//            ]
//        );
//    }
}
