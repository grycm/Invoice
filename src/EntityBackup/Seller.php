<?php

namespace InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seller
 *
 * @ORM\Table(name="seller")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\SellerRepository")
 */
class Seller
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
     * @ORM\Column(name="seller_name", type="string", length=255)
     */
    private $sellerName;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_address", type="string", length=255)
     */
    private $sellerAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_city", type="string", length=255)
     */
    private $sellerCity;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_postal", type="string", length=255)
     */
    private $sellerPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="seller_NIP", type="string", length=255)
     */
    private $sellerNIP;


    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="seller")
     */
    private $invoices;

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
     * Set sellerName
     *
     * @param string $sellerName
     * @return Seller
     */
    public function setSellerName($sellerName)
    {
        $this->sellerName = $sellerName;

        return $this;
    }

    /**
     * Get sellerName
     *
     * @return string 
     */
    public function getSellerName()
    {
        return $this->sellerName;
    }

    /**
     * Set sellerAddress
     *
     * @param string $sellerAddress
     * @return Seller
     */
    public function setSellerAddress($sellerAddress)
    {
        $this->sellerAddress = $sellerAddress;

        return $this;
    }

    /**
     * Get sellerAddress
     *
     * @return string 
     */
    public function getSellerAddress()
    {
        return $this->sellerAddress;
    }

    /**
     * Set sellerCity
     *
     * @param string $sellerCity
     * @return Seller
     */
    public function setSellerCity($sellerCity)
    {
        $this->sellerCity = $sellerCity;

        return $this;
    }

    /**
     * Get sellerCity
     *
     * @return string 
     */
    public function getSellerCity()
    {
        return $this->sellerCity;
    }

    /**
     * Set sellerPostal
     *
     * @param string $sellerPostal
     * @return Seller
     */
    public function setSellerPostal($sellerPostal)
    {
        $this->sellerPostal = $sellerPostal;

        return $this;
    }

    /**
     * Get sellerPostal
     *
     * @return string 
     */
    public function getSellerPostal()
    {
        return $this->sellerPostal;
    }

    /**
     * Set sellerNIP
     *
     * @param string $sellerNIP
     * @return Seller
     */
    public function setSellerNIP($sellerNIP)
    {
        $this->sellerNIP = $sellerNIP;

        return $this;
    }

    /**
     * Get sellerNIP
     *
     * @return string 
     */
    public function getSellerNIP()
    {
        return $this->sellerNIP;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->invoices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add invoices
     *
     * @param \InvoiceBundle\Entity\Invoice $invoices
     * @return Seller
     */
    public function addInvoice(\InvoiceBundle\Entity\Invoice $invoices)
    {
        $this->invoices[] = $invoices;

        return $this;
    }

    /**
     * Remove invoices
     *
     * @param \InvoiceBundle\Entity\Invoice $invoices
     */
    public function removeInvoice(\InvoiceBundle\Entity\Invoice $invoices)
    {
        $this->invoices->removeElement($invoices);
    }

    /**
     * Get invoices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvoices()
    {
        return $this->invoices;
    }
}
