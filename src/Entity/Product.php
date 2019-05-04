<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    
    private $instock;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", mappedBy="products")
     */
    private $category;
    public function __construct()
    {
        $this->category = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
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
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
    public function getPrice(): ?float
    {
        return $this->price;
    }
    public function setPrice(?float $price): self
    {
        $this->price = $price;
        return $this;
    }
    public function getInstock(): ?int
    {
        return $this->instock;
    }
    public function setInstock(?int $instock): self
    {
        $this->instock = $instock;
        return $this;
    }
    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }
    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
            $category->addProduct($this);
        }
        return $this;
    }
    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
            $category->removeProduct($this);
        }
        return $this;
    }
}