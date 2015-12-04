<?php

namespace Ais\UserBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Ais\UserBundle\Model\UserInterface;
use Ais\UserBundle\Form\UserType;
use Ais\UserBundle\Exception\InvalidFormException;

class UserHandler implements UserHandlerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a User.
     *
     * @param mixed $id
     *
     * @return UserInterface
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Get a list of Users.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Create a new User.
     *
     * @param array $parameters
     *
     * @return UserInterface
     */
    public function post(array $parameters)
    {
        $user = $this->createUser();

        return $this->processForm($user, $parameters, 'POST');
    }

    /**
     * Edit a User.
     *
     * @param UserInterface $user
     * @param array         $parameters
     *
     * @return UserInterface
     */
    public function put(UserInterface $user, array $parameters)
    {
        return $this->processForm($user, $parameters, 'PUT');
    }

    /**
     * Partially update a User.
     *
     * @param UserInterface $user
     * @param array         $parameters
     *
     * @return UserInterface
     */
    public function patch(UserInterface $user, array $parameters)
    {
        return $this->processForm($user, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param UserInterface $user
     * @param array         $parameters
     * @param String        $method
     *
     * @return UserInterface
     *
     * @throws \Ais\UserBundle\Exception\InvalidFormException
     */
    private function processForm(UserInterface $user, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new UserType(), $user, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $user = $form->getData();
            $this->om->persist($user);
            $this->om->flush($user);

            return $user;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createUser()
    {
        return new $this->entityClass();
    }

}
