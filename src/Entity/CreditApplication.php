<?php

namespace App\Entity;

use App\Repository\CreditApplicationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: CreditApplicationRepository::class)]
#[ORM\Table(name: "credit_applications")]
class CreditApplication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'creditApplications')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?Car $car = null;

    #[ORM\ManyToOne(inversedBy: 'creditApplications')]
    #[ORM\JoinColumn(nullable: false)]
    #[Ignore]
    private ?Credit $credit = null;

    #[ORM\Column]
    private ?int $initialPay = null;

    #[ORM\Column]
    private ?int $monthlyPay = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): static
    {
        $this->car = $car;

        return $this;
    }

    public function getCredit(): ?Credit
    {
        return $this->credit;
    }

    public function setCredit(?Credit $credit): static
    {
        $this->credit = $credit;

        return $this;
    }

    public function getInitialPay(): ?int
    {
        return $this->initialPay;
    }

    public function setInitialPay(int $initialPay): static
    {
        $this->initialPay = $initialPay;

        return $this;
    }

    public function getMonthlyPay(): ?int
    {
        return $this->monthlyPay;
    }

    public function setMonthlyPay(int $monthlyPay): static
    {
        $this->monthlyPay = $monthlyPay;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
