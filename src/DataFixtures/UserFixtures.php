<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends AbstractFixture
{
    protected UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function loadData(ObjectManager $manager)
    {
        // Users
        $this->createMany(User::class, 10, function (User $user, $u) {
            $user->setEmail("user$u@gmail.com")
                ->setFullName($this->faker->name())
                ->setPassword("password")
                ->setApiKey("api-$u-key");
        });

    }
}
