<?php

namespace Ais\UserBundle\Tests\Handler;

use Ais\UserBundle\Handler\UserHandler;
use Ais\UserBundle\Model\UserInterface;
use Ais\UserBundle\Entity\User;

class UserHandlerTest extends \PHPUnit_Framework_TestCase
{
    const DOSEN_CLASS = 'Ais\UserBundle\Tests\Handler\DummyUser';

    /** @var UserHandler */
    protected $userHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }
        
        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');

        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::DOSEN_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getName')
            ->will($this->returnValue(static::DOSEN_CLASS));
    }


    public function testGet()
    {
        $id = 1;
        $user = $this->getUser();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($user));

        $this->userHandler = $this->createUserHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $this->userHandler->get($id);
    }

    public function testAll()
    {
        $offset = 1;
        $limit = 2;

        $users = $this->getUsers(2);
        $this->repository->expects($this->once())->method('findBy')
            ->with(array(), null, $limit, $offset)
            ->will($this->returnValue($users));

        $this->userHandler = $this->createUserHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);

        $all = $this->userHandler->all($limit, $offset);

        $this->assertEquals($users, $all);
    }

    public function testPost()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $user = $this->getUser();
        $user->setTitle($title);
        $user->setBody($body);

        $form = $this->getMock('Ais\UserBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($user));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->userHandler = $this->createUserHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $userObject = $this->userHandler->post($parameters);

        $this->assertEquals($userObject, $user);
    }

    /**
     * @expectedException Ais\UserBundle\Exception\InvalidFormException
     */
    public function testPostShouldRaiseException()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $user = $this->getUser();
        $user->setTitle($title);
        $user->setBody($body);

        $form = $this->getMock('Ais\UserBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->userHandler = $this->createUserHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $this->userHandler->post($parameters);
    }

    public function testPut()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('title' => $title, 'body' => $body);

        $user = $this->getUser();
        $user->setTitle($title);
        $user->setBody($body);

        $form = $this->getMock('Ais\UserBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($user));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->userHandler = $this->createUserHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $userObject = $this->userHandler->put($user, $parameters);

        $this->assertEquals($userObject, $user);
    }

    public function testPatch()
    {
        $title = 'title1';
        $body = 'body1';

        $parameters = array('body' => $body);

        $user = $this->getUser();
        $user->setTitle($title);
        $user->setBody($body);

        $form = $this->getMock('Ais\UserBundle\Tests\FormInterface'); //'Symfony\Component\Form\FormInterface' bugs on iterator
        $form->expects($this->once())
            ->method('submit')
            ->with($this->anything());
        $form->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(true));
        $form->expects($this->once())
            ->method('getData')
            ->will($this->returnValue($user));

        $this->formFactory->expects($this->once())
            ->method('create')
            ->will($this->returnValue($form));

        $this->userHandler = $this->createUserHandler($this->om, static::DOSEN_CLASS,  $this->formFactory);
        $userObject = $this->userHandler->patch($user, $parameters);

        $this->assertEquals($userObject, $user);
    }


    protected function createUserHandler($objectManager, $userClass, $formFactory)
    {
        return new UserHandler($objectManager, $userClass, $formFactory);
    }

    protected function getUser()
    {
        $userClass = static::DOSEN_CLASS;

        return new $userClass();
    }

    protected function getUsers($maxUsers = 5)
    {
        $users = array();
        for($i = 0; $i < $maxUsers; $i++) {
            $users[] = $this->getUser();
        }

        return $users;
    }
}

class DummyUser extends User
{
}
