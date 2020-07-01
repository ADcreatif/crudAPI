<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Vehicle;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends AbstractFixture
{
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(Customer::class, 10, function(Customer $customer){

            $prefectures = ['Hokkaidō','Aomori','Iwate','Miyagi','Akita','Yamagata','Fukushima','Ibaraki','Tochigi',
                'Gunma','Saitama','Chiba','Tōkyō','Kanagawa','Toyama','Ishikawa','Fukui'];

            $customer
                ->setCompanyName($this->faker->company)
                ->setPhone($this->faker->phoneNumber)
                ->setAddressDetail($this->faker->address)
                ->setZipcode($this->faker->postcode)
                ->setPrefecture($this->faker->randomElement($prefectures));

            if($this->faker->boolean()){
                $customer->setEmail($this->faker->email);
            }

        });

        $this->createMany(Vehicle::class, 30, function(Vehicle $vehicle){
            $registrationDate = $this->faker->dateTimeBetween('-20 years','-1 years');
            $depositDate = (clone $registrationDate)->modify('+'.mt_rand(10,300).'days');

            $buyPrice = $this->faker->numberBetween(10000000,300000000);
            $sellingPrice = $buyPrice + $buyPrice * mt_rand(1,10) /100;

            $vehicle
                ->setCustomer($this->getRandomReference(Customer::class))
                ->setRegistrationNumber($this->faker->numberBetween(10000,99999))
                ->setPurchasePrice($buyPrice)
                ->setRegistrationDate($registrationDate)
                ->setSalePrice($sellingPrice)
                ->setDepositDate($depositDate);
        });

    }
}
