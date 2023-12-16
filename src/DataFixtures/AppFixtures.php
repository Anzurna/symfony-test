<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\CarBrand;
use App\Entity\Credit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 2; $i < 20; $i++) {
            $carBrand = new CarBrand();
            $carBrand->setName('Car Brand ' . $i);
            $carBrand->setCreatedAt(new \DateTimeImmutable());
            $carBrand->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($carBrand);
        }
        $manager->flush();

        for ($i = 2; $i < 100; $i++) {
            $carBrand = new Car();
            $carBrand->setModel('Car Model ' . $i);
            $brands = $this->entityManager->getRepository(CarBrand::class)->findAll();

            $carBrand->setBrand($brands[array_rand($brands)]);
            $carBrand->setPrice(random_int(1000000, 15000000));
            $carBrand->setImageUrl('Image URL ' . $i);
            $carBrand->setCreatedAt(new \DateTimeImmutable());
            $carBrand->setUpdatedAt(new \DateTimeImmutable());

            $this->entityManager->persist($carBrand);
        }

        $credit1 = new Credit();
        $credit1->setName("Test credit 1")
            ->setInterestRate(14.8)
            ->setCarPriceLowerBound(1_000_000)
            ->setCarPriceUpperBound(2_000_000)
            ->setInitialPayLowerBound(100_000)
            ->setInitialPayUpperBound(200_000)
            ->setDurationLowerBound(12)
            ->setDurationUpperBound(36)
            ->setMonthlyPayLowerBound(15000)
            ->setMonthlyPayUpperBound(20000)
            ->setPriority(100)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($credit1);

        $credit2 = new Credit();
        $credit2->setName("Test credit 2")
            ->setInterestRate(11.5)
            ->setCarPriceLowerBound(5_000_000)
            ->setCarPriceUpperBound(10_000_000)
            ->setInitialPayLowerBound(500_000)
            ->setInitialPayUpperBound(700_000)
            ->setDurationLowerBound(12)
            ->setDurationUpperBound(60)
            ->setMonthlyPayLowerBound(25000)
            ->setMonthlyPayUpperBound(50000)
            ->setPriority(200)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable());

        $manager->persist($credit2);

        $manager->flush();
    }
}
