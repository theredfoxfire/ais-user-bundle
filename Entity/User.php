<?php

namespace Ais\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ais\UserBundle\Model\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 */
class User implements UserInterface, AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $nama;

    /**
     * @var boolean
     */
    private $is_active;

    /**
     * @var boolean
     */
    private $is_delete;


	public function __construct()
	{
		$this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
		$this->apikey = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
	}
	
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set nama
     *
     * @param string $nama
     *
     * @return User
     */
    public function setNama($nama)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get nama
     *
     * @return string
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     *
     * @return User
     */
    public function setIsDelete($isDelete)
    {
        $this->is_delete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean
     */
    public function getIsDelete()
    {
        return $this->is_delete;
    }
    
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->is_active;
    }
    
    public function serialize()
    {
        return serialize(array(
			$this->id,
			$this->accessToken,
			$this->refreshToken,
			$this->authCode,
			$this->username,
			$this->password,
			$this->salt,
			$this->nama,
			$this->is_active,
			$this->is_delete
        ));
    }
    
    public function unserialize($serialized)
    {
        list (
			$this->id,
			$this->accessToken,
			$this->refreshToken,
			$this->authCode,
			$this->username,
			$this->password,
			$this->salt,
			$this->nama,
			$this->is_active,
			$this->is_delete
        ) = unserialize($serialized);
    }
    
    /**
     * Get roles
     *
     * @return array 
     */
    public function getRoles()
    {
        $roles = $this->roles;
		
		if (empty($roles)) {
			$roles[] = 'ROLE_USER';
		}
		
		return array_unique($roles);
    }
    
    public function eraseCredentials()
    {
		
	}
    /**
     * @var array
     */
    private $roles;


    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $accessToken;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $refreshToken;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $authCode;


    /**
     * Add accessToken
     *
     * @param \Ais\UserBundle\Entity\AccessToken $accessToken
     *
     * @return User
     */
    public function addAccessToken(\Ais\UserBundle\Entity\AccessToken $accessToken)
    {
        $this->accessToken[] = $accessToken;

        return $this;
    }

    /**
     * Remove accessToken
     *
     * @param \Ais\UserBundle\Entity\AccessToken $accessToken
     */
    public function removeAccessToken(\Ais\UserBundle\Entity\AccessToken $accessToken)
    {
        $this->accessToken->removeElement($accessToken);
    }

    /**
     * Get accessToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Add refreshToken
     *
     * @param \Ais\UserBundle\Entity\RefreshToken $refreshToken
     *
     * @return User
     */
    public function addRefreshToken(\Ais\UserBundle\Entity\RefreshToken $refreshToken)
    {
        $this->refreshToken[] = $refreshToken;

        return $this;
    }

    /**
     * Remove refreshToken
     *
     * @param \Ais\UserBundle\Entity\RefreshToken $refreshToken
     */
    public function removeRefreshToken(\Ais\UserBundle\Entity\RefreshToken $refreshToken)
    {
        $this->refreshToken->removeElement($refreshToken);
    }

    /**
     * Get refreshToken
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Add authCode
     *
     * @param \Ais\UserBundle\Entity\AuthCode $authCode
     *
     * @return User
     */
    public function addAuthCode(\Ais\UserBundle\Entity\AuthCode $authCode)
    {
        $this->authCode[] = $authCode;

        return $this;
    }

    /**
     * Remove authCode
     *
     * @param \Ais\UserBundle\Entity\AuthCode $authCode
     */
    public function removeAuthCode(\Ais\UserBundle\Entity\AuthCode $authCode)
    {
        $this->authCode->removeElement($authCode);
    }

    /**
     * Get authCode
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }
    /**
     * @var string
     */
    private $apikey;


    /**
     * Set apikey
     *
     * @param string $apikey
     *
     * @return User
     */
    public function setApikey($apikey)
    {
        $this->apikey = $apikey;

        return $this;
    }

    /**
     * Get apikey
     *
     * @return string
     */
    public function getApikey()
    {
        return $this->apikey;
    }
}
