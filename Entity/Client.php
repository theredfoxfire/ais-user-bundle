<?php

namespace Ais\UserBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Client extends BaseClient
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	public function __construct()
	{
		parent::__construct();
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
}
