<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $barcode = null;

    #[ORM\Column]
    private ?float $basePrice = null;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Currency $baseCurrency = null;

    #[ORM\Column]
    private ?int $stock = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): static
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getBasePrice(): ?float
    {
        return $this->basePrice;
    }

    public function setBasePrice(float $basePrice): static
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    public function getBaseCurrency(): ?Currency
    {
        return $this->baseCurrency;
    }

    public function setBaseCurrency(?Currency $baseCurrency): static
    {
        $this->baseCurrency = $baseCurrency;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCalculatedPriceVES(): float
    {
        if (!$this->baseCurrency || !$this->basePrice) {
            return 0;
        }
        return $this->basePrice * $this->baseCurrency->getExchangeRate();
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
