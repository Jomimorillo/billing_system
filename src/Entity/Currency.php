<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['currency:read']],
    denormalizationContext: ['groups' => ['currency:write']]
)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['currency:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 3)]
    #[Groups(['currency:read', 'currency:write'])]
    private ?string $code = null;

    #[ORM\Column]
    #[Groups(['currency:read', 'currency:write'])]
    private ?float $exchangeRate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getExchangeRate(): ?float
    {
        return $this->exchangeRate;
    }

    public function setExchangeRate(float $exchangeRate): static
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    public function __toString(): string
    {
        return $this->code;
    }
}
