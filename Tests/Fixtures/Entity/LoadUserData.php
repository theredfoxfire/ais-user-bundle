<?php

namespace Ais\UserBundle\Tests\Fixtures\Entity;

use Ais\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadUserData implements FixtureInterface
{
    static public $users = array();

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setTitle('title');
        $user->setBody('body');

        $manager->persist($user);
        $manager->flush();

        self::$users[] = $user;
    }
}
