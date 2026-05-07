<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\InvoiceItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: InvoiceItemRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['invoice_item:read']],
    denormalizationContext: ['groups' => ['invoice_item:write']]
)]
class InvoiceItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['invoice_item:read', 'invoice:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['invoice_item:read', 'invoice_item:write'])]
    private ?Invoice $invoice = null;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['invoice_item:read', 'invoice_item:write', 'invoice:read', 'invoice:write'])]
    private ?Product $product = null;

    #[ORM\Column]
    #[Groups(['invoice_item:read', 'invoice_item:write', 'invoice:read', 'invoice:write'])]
    private ?int $quantity = null;

    #[ORM\Column]
    #[Groups(['invoice_item:read', 'invoice_item:write', 'invoice:read', 'invoice:write'])]
    private ?float $unitPriceVES = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): static
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnitPriceVES(): ?float
    {
        return $this->unitPriceVES;
    }

    public function setUnitPriceVES(float $unitPriceVES): static
    {
        $this->unitPriceVES = $unitPriceVES;

        return $this;
    }
}
