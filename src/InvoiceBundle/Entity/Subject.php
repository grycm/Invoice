<?php

namespace InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 *
 * @ORM\Table(name="subject")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\SubjectRepository")
 */
class Subject
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=255)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="NIP", type="string", length=255)
     */
    private $nip;

    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="client")
     */
    private $receivedInvoices;
    
    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="seller")
     */
    private $issuedInvoices;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Subject
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Subject
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Subject
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return Subject
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set NIP
     *
     * @param string $nip
     *
     * @return Subject
     */
    public function setNIP($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get NIP
     *
     * @return string
     */
    public function getNIP()
    {
        return $this->nip;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->receivedInvoices = new \Doctrine\Common\Collections\ArrayCollection();
        $this->issuedInvoices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add receivedInvoice
     *
     * @param \InvoiceBundle\Entity\Invoice $receivedInvoice
     *
     * @return Subject
     */
    public function addReceivedInvoice(\InvoiceBundle\Entity\Invoice $receivedInvoice)
    {
        $this->receivedInvoices[] = $receivedInvoice;

        return $this;
    }

    /**
     * Remove receivedInvoice
     *
     * @param \InvoiceBundle\Entity\Invoice $receivedInvoice
     */
    public function removeReceivedInvoice(\InvoiceBundle\Entity\Invoice $receivedInvoice)
    {
        $this->receivedInvoices->removeElement($receivedInvoice);
    }

    /**
     * Get receivedInvoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReceivedInvoices()
    {
        return $this->receivedInvoices;
    }

    /**
     * Add issuedInvoice
     *
     * @param \InvoiceBundle\Entity\Invoice $issuedInvoice
     *
     * @return Subject
     */
    public function addIssuedInvoice(\InvoiceBundle\Entity\Invoice $issuedInvoice)
    {
        $this->issuedInvoices[] = $issuedInvoice;

        return $this;
    }

    /**
     * Remove issuedInvoice
     *
     * @param \InvoiceBundle\Entity\Invoice $issuedInvoice
     */
    public function removeIssuedInvoice(\InvoiceBundle\Entity\Invoice $issuedInvoice)
    {
        $this->issuedInvoices->removeElement($issuedInvoice);
    }

    /**
     * Get issuedInvoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIssuedInvoices()
    {
        return $this->issuedInvoices;
    }
}
