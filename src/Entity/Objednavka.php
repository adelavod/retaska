<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjednavkaRepository")
 */
class Objednavka
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surname;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $psc;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country")
     */
    private $country;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Payment")
     */
    private $payment;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $poznamka;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shipping")
     */
    private $shipping;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalprice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $count;


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getProduct(): ?Product
    {
        return $this->product;
    }
    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }
    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getSurname(): ?string
    {
        return $this->surname;
    }
    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }
    public function getStreet(): ?string
    {
        return $this->street;
    }
    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }
    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }
    public function getPsc(): ?int
    {
        return $this->psc;
    }
    public function setPsc(?int $psc): self
    {
        $this->psc = $psc;
        return $this;
    }
    public function getCountry(): ?Country
    {
        return $this->country;
    }
    public function setCountry(?Country $country): self
    {
        $this->country = $country;
        return $this;
    }
    public function getPayment(): ?Payment
    {
        return $this->payment;
    }
    public function setPayment(?Payment $payment): self
    {
        $this->payment = $payment;
        return $this;
    }
    public function getPoznamka(): ?string
    {
        return $this->poznamka;
    }
    public function setPoznamka(?string $poznamka): self
    {
        $this->poznamka = $poznamka;
        return $this;
    }

    public function getTotalprice(): ?float
    {
        return $this->totalprice;
    }

    public function setTotalprice(?float $totalprice): self
    {
        $this->totalprice = $totalprice;

        return $this;
    }

    public function getShipping(): ?Shipping
    {
        return $this->shipping;
    }

    public function setShipping(?Shipping $shipping): self
    {
        $this->shipping = $shipping;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }
}