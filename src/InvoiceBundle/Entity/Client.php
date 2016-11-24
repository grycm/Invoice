<?php

namespace InvoiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="InvoiceBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="client_name", type="string", length=255)
     */
    private $clientName;

    /**
     * @var string
     *
     * @ORM\Column(name="client_address", type="string", length=255)
     */
    private $clientAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="client_city", type="string", length=255)
     */
    private $clientCity;

    /**
     * @var string
     *
     * @ORM\Column(name="client_postal", type="string", length=255)
     */
    private $clientPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="client_NIP", type="string", length=255)
     */
    private $clientNIP;

    /**
     * @ORM\OneToMany(targetEntity="Invoice", mappedBy="client")
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
     * Set clientName
     *
     * @param string $clientName
     * @return Client
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * Get clientName
     *
     * @return string 
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set clientAddress
     *
     * @param string $clientAddress
     * @return Client
     */
    public function setClientAddress($clientAddress)
    {
        $this->clientAddress = $clientAddress;

        return $this;
    }

    /**
     * Get clientAddress
     *
     * @return string 
     */
    public function getClientAddress()
    {
        return $this->clientAddress;
    }

    /**
     * Set clientCity
     *
     * @param string $clientCity
     * @return Client
     */
    public function setClientCity($clientCity)
    {
        $this->clientCity = $clientCity;

        return $this;
    }

    /**
     * Get clientCity
     *
     * @return string 
     */
    public function getClientCity()
    {
        return $this->clientCity;
    }

    /**
     * Set clientPostal
     *
     * @param string $clientPostal
     * @return Client
     */
    public function setClientPostal($clientPostal)
    {
        $this->clientPostal = $clientPostal;

        return $this;
    }

    /**
     * Get clientPostal
     *
     * @return string 
     */
    public function getClientPostal()
    {
        return $this->clientPostal;
    }

    /**
     * Set clientNIP
     *
     * @param string $clientNIP
     * @return Client
     */
    public function setClientNIP($clientNIP)
    {
        $this->clientNIP = $clientNIP;

        return $this;
    }

    /**
     * Get clientNIP
     *
     * @return string 
     */
    public function getClientNIP()
    {
        return $this->clientNIP;
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
     * @return Client
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
