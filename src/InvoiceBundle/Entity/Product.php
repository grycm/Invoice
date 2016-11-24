<?php

namespace InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="product_name", type="string", length=255)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="product_quantity", type="string", length=255)
     */
    private $productQuantity;

    /**
     * @var string
     *
     * @ORM\Column(name="netto_price", type="string", length=255)
     */
    private $nettoPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="netto_value", type="string", length=255)
     */
    private $nettoValue;

    /**
     * @var string
     *
     * @ORM\Column(name="vat", type="string", length=255)
     */
    private $vat;

    /**
     * @var string
     *
     * @ORM\Column(name="vat_value", type="string", length=255)
     */
    private $vatValue;

    /**
     * @var string
     *
     * @ORM\Column(name="brutto_value", type="string", length=255)
     */
    private $bruttoValue;

    /**
     * @ORM\ManyToOne(targetEntity="Invoice", inversedBy="products")
     * @ORM\JoinColumn(name="invoice_id", referencedColumnName="id")
     */
    private $invoice;


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
     * Set productName
     *
     * @param string $productName
     * @return Product
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string 
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set productQuantity
     *
     * @param string $productQuantity
     * @return Product
     */
    public function setProductQuantity($productQuantity)
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    /**
     * Get productQuantity
     *
     * @return string 
     */
    public function getProductQuantity()
    {
        return $this->productQuantity;
    }

    /**
     * Set nettoPrice
     *
     * @param string $nettoPrice
     * @return Product
     */
    public function setNettoPrice($nettoPrice)
    {
        $this->nettoPrice = $nettoPrice;

        return $this;
    }

    /**
     * Get nettoPrice
     *
     * @return string 
     */
    public function getNettoPrice()
    {
        return $this->nettoPrice;
    }

    /**
     * Set nettoValue
     *
     * @param string $nettoValue
     * @return Product
     */
    public function setNettoValue($nettoValue)
    {
        $this->nettoValue = $nettoValue;

        return $this;
    }

    /**
     * Get nettoValue
     *
     * @return string 
     */
    public function getNettoValue()
    {
        return $this->nettoValue;
    }

    /**
     * Set vat
     *
     * @param string $vat
     * @return Product
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return string 
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set vatValue
     *
     * @param string $vatValue
     * @return Product
     */
    public function setVatValue($vatValue)
    {
        $this->vatValue = $vatValue;

        return $this;
    }

    /**
     * Get vatValue
     *
     * @return string 
     */
    public function getVatValue()
    {
        return $this->vatValue;
    }

    /**
     * Set bruttoValue
     *
     * @param string $bruttoValue
     * @return Product
     */
    public function setBruttoValue($bruttoValue)
    {
        $this->bruttoValue = $bruttoValue;

        return $this;
    }

    /**
     * Get bruttoValue
     *
     * @return string 
     */
    public function getBruttoValue()
    {
        return $this->bruttoValue;
    }

    /**
     * Set invoice
     *
     * @param \InvoiceBundle\Entity\Invoice $invoice
     * @return Product
     */
    public function setInvoice(\InvoiceBundle\Entity\Invoice $invoice = null)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return \InvoiceBundle\Entity\Invoice 
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}
