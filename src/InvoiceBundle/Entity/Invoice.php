<?php

namespace InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\InvoiceRepository")
 */
class Invoice
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_number", type="string", length=255)
     */
    private $invoiceNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="generation_date", type="string", length=255)
     */
    private $generationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="completion_date", type="string", length=255)
     */
    private $completionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="invoice", cascade={"persist"})
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="issuedInvoices")
     * @ORM\JoinColumn(name="seller_id", referencedColumnName="id")
     */
    private $seller;

    /**
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="receivedInvoices")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set invoiceNumber
     *
     * @param string $invoiceNumber
     * @return Invoice
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Get invoiceNumber
     *
     * @return string 
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Set generationDate
     *
     * @param string $generationDate
     * @return Invoice
     */
    public function setGenerationDate($generationDate)
    {
        $this->generationDate = $generationDate;

        return $this;
    }

    /**
     * Get generationDate
     *
     * @return string 
     */
    public function getGenerationDate()
    {
        return $this->generationDate;
    }

    /**
     * Set completionDate
     *
     * @param string $completionDate
     * @return Invoice
     */
    public function setCompletionDate($completionDate)
    {
        $this->completionDate = $completionDate;

        return $this;
    }

    /**
     * Get completionDate
     *
     * @return string 
     */
    public function getCompletionDate()
    {
        return $this->completionDate;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Invoice
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Invoice
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add products
     *
     * @param \InvoiceBundle\Entity\Product $products
     * @return Invoice
     */
    public function addProduct(\InvoiceBundle\Entity\Product $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \InvoiceBundle\Entity\Product $products
     */
    public function removeProduct(\InvoiceBundle\Entity\Product $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set seller
     *
     * @param \InvoiceBundle\Entity\Subject $seller
     * @return Invoice
     */
    public function setSeller(\InvoiceBundle\Entity\Subject $seller = null)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller
     *
     * @return \InvoiceBundle\Entity\Subject 
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Set client
     *
     * @param \InvoiceBundle\Entity\Subject $client
     * @return Invoice
     */
    public function setClient(\InvoiceBundle\Entity\Subject $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \InvoiceBundle\Entity\Subject 
     */
    public function getClient()
    {
        return $this->client;
    }
}
