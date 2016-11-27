<?php

namespace InvoiceBundle\Controller;

use InvoiceBundle\Entity\Invoice;
use InvoiceBundle\Entity\Product;
use InvoiceBundle\Entity\Subject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        //dump($request->request);
        $em = $this->getDoctrine()->getManager();

        //get Invoice data from form
        $invoice = $this->getInvoiceData($request);

        //get Seller Data from form
        $seller = $this->getSubjectData($request, 'seller');
        $em->persist($seller);
        
        //get Clinet Data from form
        $client = $this->getSubjectData($request, 'client');
        $em->persist($client);
        
        //add Seller and Clinet to Invoice
        $invoice->setClient($client);
        $invoice->setSeller($seller);

        foreach ($request->request->get('product') as $product) {
            $pProduct = $this->getProductData($product);

            //add Product to Invoice
            $em->persist($pProduct);
            $pProduct->setInvoice($invoice);
        }


        //flush everything
        $em->persist($invoice);
        $em->flush();

        return $this->redirectToRoute('showInvoice', ['id' => $invoice->getId()]);
    }


    /*
     * Use 'client' or 'seller' as $type, so you get
     * 'seller_NIP' from $type.'_NIP' etc
     */
    private function getSubjectData(Request $request, $type)
    {
        $nip = $request->request->get($type.'_NIP');
        $name = $request->request->get($type.'_name');
        $address = $request->request->get($type.'_address');
        $city = $request->request->get($type.'_city');
        $zipCode = $request->request->get($type.'_postal');

        //set Seller Data
        $subject = new Subject();
        $subject->setName($name);
        $subject->setAddress($address);
        $subject->setCity($city);
        $subject->setZipCode($zipCode);
        $subject->setNIP($nip);
        
        return $subject;
    }
    
    private function getInvoiceData(Request $request)
    {
        $number = $request->request->get('invoice_number');
        $generationDate = $request->request->get('generation_date');
        $completionDate = $request->request->get('completion_date');
        $place = $request->request->get('place');
        $comment = $request->request->get('comment');

        //set Invoice data
        $invoice = new Invoice();
        $invoice->setNumber($number);
        $invoice->setGenerationDate($generationDate);
        $invoice->setCompletionDate($completionDate);
        $invoice->setPlace($place);
        $invoice->setComment($comment);
        
        return $invoice;
    }
    
    private function getProductData($product)
    {
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
        
        return $pProduct;
    }


    /**
     * @Route("/show/{id}", name="showInvoice")
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
     * @Route("/api/seller_search")
     *
     */
    public function sellerSearchAction(Request $request)
    {

        $phrase = $request->request->get('phrase');

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT seller FROM InvoiceBundle:Seller seller WHERE seller.sellerName LIKE :name'
        )->setParameter('name', "%$phrase%");

        $sellers = $query->getResult();

        $response =[];
        foreach ($sellers as $seller) {
            $response[] = [
                'sellerName' => $seller->getSellerName(),
                'id' => $seller->getId(),
                'sellerAddress' => $seller->getSellerAddress(),
                'sellerCity' => $seller->getSellerCity(),
                'sellerPostal'=> $seller->getSellerPostal(),
                'sellerNIP' => $seller->getSellerNIP(),
            ];
        }


        return new JsonResponse($response);
    }

    /**
     * @Route("/api/client_search")
     *
     */
    public function clientSearchAction(Request $request)
    {

        $phrase = $request->request->get('phrase');

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT client FROM InvoiceBundle:Client client WHERE client.clientName LIKE :name'
        )->setParameter('name', "%$phrase%");

        $clients = $query->getResult();

        $response =[];
        foreach ($clients as $client) {
            $response[] = [
                'clientName' => $client->getClientName(),
                'id' => $client->getId(),
                'clientAddress' => $client->getClientAddress(),
                'clientCity' => $client->getClientCity(),
                'clientPostal'=> $client->getClientPostal(),
                'clientNIP' => $client->getClientNIP(),
            ];
        }


        return new JsonResponse($response);
    }
    
    /**
     * 
     * @Route("/showAll", name="showAll")
     * @Template
     */
    public function showAllAction()
    {
        $repo = $this->getDoctrine()->getRepository('InvoiceBundle:Invoice');
        
        $invoices = $repo->findAll();
        
        return ['invoices' => $invoices];
    }
    
    public function showExceptionAction()
    {
        return $this->redirect('/snake/index.html');
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
