<?php

namespace Ais\UserBundle\DataFixtures\ORM;

use Ais\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoasUser implements FixtureInterface, ContainerAwareInterface
{
	private $container;
	
	public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
	
	public function load(ObjectManager $manager)
	{
		$this->loadUsers($manager);
	}
	
    private function loadUsers(ObjectManager $manager)
    {
        $johnUser = new User();
        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($johnUser);
        $johnUser->setUsername('user');
        $johnUser->setNama('John');
        $johnUser->setIsActive(true);
        $encodedPassword = $encoder->encodePassword('12345', $johnUser->getSalt());
        $johnUser->setPassword($encodedPassword);
        $manager->persist($johnUser);
        
        $manager->flush();
    }
}
