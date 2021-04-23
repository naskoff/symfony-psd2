<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface, OrderedFixtureInterface
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $user->setUsername('zlatin.hristov@giftcards.eu');
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, '123'));

        $manager->persist($user);
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['USER', 'SYSTEM'];
    }

    public function getOrder()
    {
        return 1;
    }
}
