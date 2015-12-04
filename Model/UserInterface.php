<?php

namespace Ais\UserBundle\Model;

Interface UserInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password);

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt);

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt();

    /**
     * Set nama
     *
     * @param string $nama
     *
     * @return User
     */
    public function setNama($nama);

    /**
     * Get nama
     *
     * @return string
     */
    public function getNama();

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive);

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive();

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return User
     */
    public function setIsDelete($isDelete);

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete();
}
