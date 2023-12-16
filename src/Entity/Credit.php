<?php

namespace App\Entity;

use App\Repository\CreditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreditRepository::class)]
#[ORM\Table(name: "credits")]
class Credit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $interestRate = null;

    #[ORM\Column(nullable: true)]
    private ?int $carPriceLowerBound = null;

    #[ORM\Column(nullable: true)]
    private ?int $carPriceUpperBound = null;

    #[ORM\Column(nullable: true)]
    private ?int $monthlyPayLowerBound = null;

    #[ORM\Column(nullable: true)]
    private ?int $monthlyPayUpperBound = null;

    #[ORM\Column(nullable: true)]
    private ?int $durationLowerBound = null;

    #[ORM\Column(nullable: true)]
    private ?int $durationUpperBound = null;

    #[ORM\Column(nullable: true)]
    private ?int $initialPayLowerBound = null;

    #[ORM\Column(nullable: true)]
    private ?int $initialPayUpperBound = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\OneToMany(mappedBy: 'credit', targetEntity: CreditApplication::class)]
    private Collection $creditApplications;

    public function __construct()
    {
        $this->creditApplications = new ArrayCollection();
    }

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

    public function getInterestRate(): ?float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $interestRate): static
    {
        $this->interestRate = $interestRate;

        return $this;
    }

    public function getCarPriceLowerBound(): ?int
    {
        return $this->carPriceLowerBound;
    }

    public function setCarPriceLowerBound(?int $carPriceLowerBound): static
    {
        $this->carPriceLowerBound = $carPriceLowerBound;

        return $this;
    }

    public function getCarPriceUpperBound(): ?int
    {
        return $this->carPriceUpperBound;
    }

    public function setCarPriceUpperBound(?int $carPriceUpperBound): static
    {
        $this->carPriceUpperBound = $carPriceUpperBound;

        return $this;
    }

    public function getMonthlyPayLowerBound(): ?int
    {
        return $this->monthlyPayLowerBound;
    }

    public function setMonthlyPayLowerBound(?int $monthlyPayLowerBound): static
    {
        $this->monthlyPayLowerBound = $monthlyPayLowerBound;

        return $this;
    }

    public function getMonthlyPayUpperBound(): ?int
    {
        return $this->monthlyPayUpperBound;
    }

    public function setMonthlyPayUpperBound(?int $monthlyPayUpperBound): static
    {
        $this->monthlyPayUpperBound = $monthlyPayUpperBound;

        return $this;
    }

    public function getDurationLowerBound(): ?int
    {
        return $this->durationLowerBound;
    }

    public function setDurationLowerBound(?int $durationLowerBound): static
    {
        $this->durationLowerBound = $durationLowerBound;

        return $this;
    }

    public function getDurationUpperBound(): ?int
    {
        return $this->durationUpperBound;
    }

    public function setDurationUpperBound(?int $durationUpperBound): static
    {
        $this->durationUpperBound = $durationUpperBound;

        return $this;
    }

    public function getInitialPayLowerBound(): ?int
    {
        return $this->initialPayLowerBound;
    }

    public function setInitialPayLowerBound(?int $initialPayLowerBound): static
    {
        $this->initialPayLowerBound = $initialPayLowerBound;

        return $this;
    }

    public function getInitialPayUpperBound(): ?int
    {
        return $this->initialPayUpperBound;
    }

    public function setInitialPayUpperBound(?int $initialPayUpperBound): static
    {
        $this->initialPayUpperBound = $initialPayUpperBound;

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

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection<int, CreditApplication>
     */
    public function getCreditApplications(): Collection
    {
        return $this->creditApplications;
    }

    public function addCreditApplication(CreditApplication $creditApplication): static
    {
        if (!$this->creditApplications->contains($creditApplication)) {
            $this->creditApplications->add($creditApplication);
            $creditApplication->setCredit($this);
        }

        return $this;
    }

    public function removeCreditApplication(CreditApplication $creditApplication): static
    {
        if ($this->creditApplications->removeElement($creditApplication)) {
            // set the owning side to null (unless already changed)
            if ($creditApplication->getCredit() === $this) {
                $creditApplication->setCredit(null);
            }
        }

        return $this;
    }
}
